<form action="{{ route('admin.staff.update', $staff->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row mb-3">
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="avatar">{{ __('Avatar') }}</label>
            <x-img-up name="avatar" :old="$staff->avatar" :ref="'coevs-profile-img'"/>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="first_name">{{ __('First Name') }}</label>
            <input class="form-control" type="text" name="first_name" value="{{ $staff->first_name }}"
                   placeholder="Staff First Name" required>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="last_name">{{ __('Last Name') }}</label>
            <input class="form-control" type="text" name="last_name" value="{{ $staff->last_name }}"
                   placeholder="Staff Last Name" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="email">{{ __('Staff Email') }}</label>
            <input class="form-control" type="email" name="email" value="{{ $staff->email }}"
                   placeholder="Staff Email" required>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="role">{{ __('Select Role') }}</label>
            <select class="form-select" name="role" required>
                <option selected disabled>{{ __('Select Role') }}</option>
                @foreach($roles as $role)
                <option @selected($staffRole == $role) value="{{ $role }}">{{ title($role) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="password">{{ __('Staff Password') }}</label>
            <input class="form-control" type="password" name="password" placeholder="Staff Password">
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <label class="form-label" for="confirm_password">{{ __('Confirm Password') }}</label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
    </div>
    @if($staff->id != 1)
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-12">
                <label class="form-label" for="status">{{ __('Status') }}</label>
                <div class="form-check form-switch">
                    <input class="form-check-input coevs-switch" type="checkbox" name="status"
                           value="1" @checked($staff->status)>
                </div>

            </div>
        </div>
    @endif
    <div class="text-end">
        <button class="btn btn-info" type="submit">
            <x-icon name="check" height="20"/> {{ __('Update Staff') }}
        </button>
    </div>
</form>
