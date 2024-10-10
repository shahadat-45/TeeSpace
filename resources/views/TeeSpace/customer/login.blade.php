<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>TeeSpace</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="{{ asset('frontend') }}/assets/main_css/login.css">
      <style>
         .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
         }
         .alert-success {
            color: #085f2e;
            background-color: #cff1de;
            border-color: #bcebd1;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <header>Login Form</header>
         @if (session('register_success'))
            <div class="alert alert-success">{{ session('register_success') }}</div>
         @endif
         <form action="{{ route('customer.login.post') }}" method="POST">
            @csrf
            <div class="input-field">
               <input type="text" name="email">
               <label>Email or Username</label>
            </div>
            <div class="input-field">
               <input class="pswrd" type="password" name="password">
               <span class="show">SHOW</span>
               <label>Password</label>
            </div>
            <div class="button">
               <div class="inner"></div>
               <button type="submit">LOGIN</button>
            </div>
         </form>
         <div class="auth">
            Or login with
         </div>
         <div class="links">
            <div class="facebook">
               <i class="fab fa-facebook-square"><span>Facebook</span></i>
            </div>
            <div class="google">
               <i class="fab fa-google-plus-square"><span>Google</span></i>
            </div>
         </div>
         <div class="signup">
            Not a member? <a href="{{ route('customer.registration') }}">Signup now</a>
         </div>
      </div>
      <script>
         var input = document.querySelector('.pswrd');
         var show = document.querySelector('.show');
         show.addEventListener('click', active);
         function active(){
           if(input.type === "password"){
             input.type = "text";
             show.style.color = "#1DA1F2";
             show.textContent = "HIDE";
           }else{
             input.type = "password";
             show.textContent = "SHOW";
             show.style.color = "#111";
           }
         }
      </script>
   </body>
</html>