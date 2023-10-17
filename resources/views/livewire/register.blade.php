
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 ">
            <form class="col-lg-6 offset-lg-3" wire:submit.prevent="register">
                @if (session()->has('message'))
                <div class="alert alert-danger text-center">{{ session('message') }}</div>
                @endif
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username"  wire:model="username" placeholder="Enter username">
                    @error('username')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  wire:model="email" placeholder="Enter email">
                    @error('email')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" wire:model="password"  placeholder="Password">
                    @error('password')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input type="password" class="form-control" id="password_confirmation" wire:model="password_confirmation"  placeholder="Password confirmation">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>