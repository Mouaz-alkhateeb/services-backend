<!DOCTYPE html>
<html>

<head>
    <title>تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="myCard">
            <div class="row">
                <div class="col-md-6">
                    <div class="myLeftCtn">
                        <form method="POST" action="{{ route('login') }}" class="myForm text-center">
                            @csrf
                            <h1>تسجيل الدخول باستخدام</h1>
                            <div class="social-container">
                                <a href="/auth/redirect/google" class="social"><i class="fab fa-google-plus-g"></i></a>
                                <a href="/auth/redirect/github" class="social"><i class="fab fa-github"></i></a>
                            </div>
                            <h6>أو من خلال بريدك الالكتروني</h6>
                          
                            <div class="form-group" >
                                <i class="fas fa-envelope"></i>
                                <input class="myInput @error('email') is-invalid @enderror" name="email"
                                    placeholder="البريد الالكتروني" type="email" id="email" value="{{ old('email') }}"
                                    required autocomplete="email" >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input class="myInput @error('password') is-invalid @enderror" type="password"
                                    id="password" placeholder="كلمة السر" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row" align="right">
                                <div class="col-md-6 offset-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="color: #0299D1">
                                            {{ __(' تذكرني') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0 offset-md-1" ">
                                <div class="col-md-6" >
                                    <input type="submit" class="butt" value="دخول">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}"
                                    style="color: #0299D1" >
                                        {{ __('هل نسيت كلمة السر ؟') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="myRightCtn">
                        <div class="box" align="right">
                        <header>مرحبا بكم</header>
                            <br>
                            <h6>منصة تتيح لأصحاب المشاريع والشركات التعاقد مع مقدمين خدمات محترفين </h6>
                            <br>
                                <input type="button" class="butt_out" value="لمعرفة المزيد" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>



</html>
