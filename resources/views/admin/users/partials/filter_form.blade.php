<form action="{{ route('users') }}" method="GET" class="mb-3">
    <div class="form-row mb-2">
        <div class="col-3">
            <input type="text" class="{{ className(['form-control', 'form-control-lg', 'border'], [$errors->has('username') ? 'is-invalid' : null]) }}" placeholder="Username" name="username" value={{ array_get($input, 'username') }}>
        </div>

        <div class="col-3">
            <input type="text" class="{{ className(['form-control', 'form-control-lg', 'border'], [$errors->has('name') ? 'is-invalid' : null]) }}" placeholder="Name" name="name" value={{ array_get($input, 'name') }}>
        </div>

        <div class="col-3">
            <input type="text" class="{{ className(['form-control', 'form-control-lg', 'border'], [$errors->has('email') ? 'is-invalid' : null]) }}" placeholder="Email" name="email" value={{ array_get($input, 'email') }}>
        </div>

        <div class="input-group col-3">
            <select class="{{ className(['form-control', 'form-control-lg', 'selectpicker'], [$errors->has('status') ? 'is-invalid' : null]) }}" name="status" title="(Status)" data-style="bg-white border">
                @foreach($data['status_list'] as $identifier => $status)
                    <option value="{{ $identifier }}" {{ array_get($input, 'status', 'all') === $identifier ? 'selected="selected"' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </div>
</form>
