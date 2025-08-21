<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/font-acawesome.min.css' />
   <style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(to right, #f1f1cc, #c471ed, #12c2e9);
}

.wrapper{
    position: relative;
    width: 400px;
    height: 500px;
    background: rgba(255,255,255,0.2);
    border-radius: 20px;
    box-shadow: 0 0 50px rgba(0,0,0,0.1);
    padding: 40px;
}

.form-wrapper{
    display: flex;
    align-items: center;
    width: 100%;
    height: 100%;
    transition: 1s ease-in-out;
}

.wrapper.active .form-wrapper.sign-in{
    transform: scale(0) translate(-300px, 500px);
}

.wrapper .form-wrapper.sign-up{
    position: absolute;
    top: 0; 
    transform: scale(0) translate(200px, -500px);
}

.wrapper.active .form-wrapper.sign-up {
    transform: scale(1) translate(0, 0);
}

h2{
    font-size: 30px;
    color: #fff;
    text-align: center;
}

.input-group{
    position: relative;
    margin: 30px 0;
    border-bottom: 2px solid #fff;
}

.input-group label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #fff;
    pointer-events: none;
    transition: .5s;
}

.input-group input{
    width: 320px;
    height: 40px;
    font-size: 16px;
    color: #fff;
    padding: 0 5px;
    background: transparent;
    border: none;
    outline: none;  
}

.input-group input:focus~label,
.input-group input:valid~label
{
    top: -5px;
}

.remember{
    margin: -5px 0 15px 5px;
}

.remember color{
    color: #fff;
    font-size: 14px;
}

.remember label input{
    accent-color: #f4157e;
}

button{
    position: relative;
    width: 100%;
    height: 40px;
    background: #f4157e;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    border-radius: 30px;
    border: none;
    outline: none;
}

.signUp-link{
    font-size: 14px;
    text-align: center;
    margin: 15px 0;
}

.signUp-link p{
    color: #fff;
}

.signUp-link p a{
    color: #f4157e;
    text-decoration: none;
    font-weight: 500;
}

.signUp-link p a:hover{
    text-decoration: underline;
}

.social-platform{
    font-size: 14px;
    color: #fff;
    text-align: center;
}

.social-icons a{
    display: inline-block;
    width: 35px;
    height: 35px;
    background: transparent;
    border: 1px solid #fff;
    border-radius: 50%;
    text-align: center;
    line-height: 35px;
    margin: 15px 6px 0;
    transition: .3s;
}

.social-icons a:hover{
    background: #fff;
}

.social-icons a i{
    color: #fff;
    font-size: 14px;
    transition: .3s;
}

.social-icons a:hover i{
    color: rgba(0,0,0,0.3);
}


   </style>
</head>
<body>

    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <form action="{{ url('/admin/login') }}" method="POST">
                @csrf
                <h2>Admin</h2>
                  <!-- Form Đăng nhập -->
            @if(session('error'))
                <div style="color:red; text-align:center; margin:10px 0; border:1px solid red; padding:10px; border-radius:5px;">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div style="color:green; text-align:center; margin:10px 0; border:1px solid green; padding:10px; border-radius:5px;">
                    {{ session('success') }}
                </div>
            @endif
                <div class="input-group">
                    <input type="email" name="email" required />
                    <label>Email đăng nhập</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" required />
                    <label>Mật khẩu</label>
                </div>
                <button type="submit">Đăng nhập</button>
                <div class="signUp-link">
                    <p>Bạn muốn cấp quyền admin? 
                        <a href="#" class="SignUpBtn-link">Cấp quyền</a>
                    </p>
                </div>
            </form>
        </div>

      <!-- Form Cấp quyền Admin -->
      <div class="form-wrapper sign-up">
        
        <form action="{{ url('/admin/create') }}" method="POST">
            @csrf
            <h2>Phân quyền admin</h2>
            <!-- Form Đăng nhập -->
            @if(session('error'))
                <div style="color:red; text-align:center; margin:10px 0; border:1px solid red; padding:10px; border-radius:5px;">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div style="color:green; text-align:center; margin:10px 0; border:1px solid green; padding:10px; border-radius:5px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="input-group">
                <input type="text" name="name" required />
                <label>Tên quản trị</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" required />
                <label>Email đăng nhập</label>
            </div>
            <div class="input-group">
                <input type="password" name="new_password" required />
                <label>Mật khẩu</label>
            </div>
            <div class="input-group">
                <input type="password" name="super_password" required />
                <label>Mật khẩu admin xác nhận</label>
            </div>
            <button type="submit">Cấp quyền</button>
            <div class="signUp-link">
                <p>Đăng nhập vào trang admin ?
                    <a href="#" class="SignInBtn-link">Đăng nhập</a>
                </p>
            </div>
        </form>
      </div>

    </div>

<script>
    const signUpBtnLink = document.querySelector('.SignUpBtn-link');
    const signInBtnLink = document.querySelector('.SignInBtn-link');
    const wrapper = document.querySelector('.wrapper');

    signUpBtnLink.addEventListener('click', (e) => {
        e.preventDefault();
        wrapper.classList.add('active');
    });

    signInBtnLink.addEventListener('click', (e) => {
        e.preventDefault();
        wrapper.classList.remove('active');
    });
</script>
</body>
</html>