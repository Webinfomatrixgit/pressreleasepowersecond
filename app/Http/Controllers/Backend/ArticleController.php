<?php

namespace App\Http\Controllers\Backend;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Article;
use App\Traits\FileManageTrait;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServicesController extends Controller
{
    use FileManageTrait;

    public function __construct()
    {
        // Define permissions for each action
        $permissions = [
            'index' => 'article-list',
            'create' => 'article-manage',
            'store' => 'article-manage',
            'edit' => 'article-manage',
            'update' => 'article-manage',
            'destroy' => 'article-manage',
        ];
        $this->permissionAuthorization($permissions);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve only required columns to optimize the query
        $services = Article::select('id', 'title', 'meta_title', 'meta_description', 'meta_keywords', 'status')->get();

        return view('backend.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws Throwable
     */
    public function store(StoreUpdateRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $this->prepareData($request);

            // Handle file uploads
            $validated = $this->handleFileUploads($request, $validated);

            // Handle multilingual fields
            $validated = $this->handleMultilingualFields($request, $validated);

            // Create service
            Services::create($validated);

            notifyEvs('success', __('Article Created Successfully'));
        });

        return redirect()->route('admin.article.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {

        $languages = Language::where('status', Status::ACTIVE)->pluck('name', 'code');

        return view('backend.article.edit', compact('article', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Throwable
     */
    public function update(StoreUpdateRequest $request, article $article)
    {
        DB::transaction(function () use ($request, $article) {
            $langCode = request('lang');
            $validated = $this->prepareData($request, $article, $langCode);

            // Handle file uploads
            $validated = $this->handleFileUploads($request, $validated, $article);

            // Handle multilingual fields
            $validated = $this->handleMultilingualFields($request, $validated, $artucke, $langCode);

            // Update service
            $service->update($validated);

            notifyEvs('success', __('Article Updated Successfully'));
        });

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws Throwable
     */
    public function destroy(Article $service)
    {
        DB::transaction(function () use ($article) {
            // Delete associated files
            collect([$article->light_icon, $article->dark_icon, $article->cover, $article->video_cover])
                ->filter()
                ->each(fn ($image) => $this->deleteImage($image));

            // Delete related tasks via orders
            $article->orders->each(function ($order) {
                $order->tasks()->delete(); // Delete tasks related to this order
                $order->delete(); // Delete the order
            });

            // Delete the service
            $service->delete();

            notifyEvs('success', __('Service Deleted Successfully'));
        });

        return redirect()->route('admin.service.index');
    }

    /**
     * Prepare validated data and handle status.
     */
    private function prepareData(StoreUpdateRequest $request, $service = null, $langCode = null)
    {
        $isStaticDefaultLang = $langCode === config('app.static_default_language');

        return $request->validated() + [
            'status' => $service && ! $isStaticDefaultLang ? $service->status : (int) $request->has('status'),
        ];
    }

    /**
     * Handle file uploads for the service.
     */
    private function handleFileUploads($request, array $validated, $service = null)
    {
        $files = ['light_icon', 'dark_icon', 'cover', 'video_cover'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $validated[$file] = $this->uploadImage(
                    $request->file($file),
                    $service ? $service->$file : null
                );
            }
        }

        return $validated;
    }

    /**
     * Handle multilingual fields like name and description.
     */
    private function handleMultilingualFields($request, array $validated, $service = null, $langCode = null)
    {
        $fields = ['name', 'description', 'side_content', 'faq_content'];
        $fallbackLocale = config('app.fallback_locale');
        $langCode = $langCode ?? $fallbackLocale;

        foreach ($fields as $field) {
            // Reset array keys for list in specific fields
            if (in_array($field, ['side_content', 'faq_content']) && isset($validated[$field]['list'])) {
                $validated[$field]['list'] = array_values($validated[$field]['list']);
            }

            // Merge existing service data for multilingual fields
            $existingData = $service ? $service->$field : [];

            // Merge and set the validated data
            $validated[$field] = array_merge($existingData, [$langCode => $validated[$field]]);
        }

        return $validated;
    }
}
