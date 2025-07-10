<!-- Javascripts -->
<script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/main.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    const elementOfPassword = document.querySelector('.show_or_hide_password');
    const passwordInput = document.querySelector('input[name="password"]');
    let isHide = true;

    elementOfPassword.addEventListener('click', (e) => {
        e.preventDefault();
        isHide = !isHide;
        if (isHide) {
            passwordInput.type = 'password';
            elementOfPassword.innerHTML = '<i class="show_password fa fa-eye h5"></i>';
        } else {
            passwordInput.type = 'text';
            elementOfPassword.innerHTML = '<span class="hide_password h4">🙈</span>';
        }
    });
</script>
</body>

</html>