

<?php $__env->startSection('content'); ?>
<div class="card" style="max-width: 520px; margin: 0 auto;">
    <div class="section-title">
        <h1>Вход</h1>
        <div class="tag">Доступ к профилю</div>
    </div>
    <form action="<?php echo e(route('login')); ?>" method="POST" class="grid">
        <?php echo csrf_field(); ?>
        <div>
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" value="<?php echo e(old('login')); ?>" required minlength="6">
            <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required minlength="8">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="actions">
            <label style="display:flex; align-items:center; gap:6px; font-size:14px; color:var(--muted);">
                <input type="checkbox" name="remember" value="1" style="width:16px; height:16px;">
                Запомнить меня
            </label>
        </div>
        <div class="actions">
            <button type="submit" class="btn accent">Войти</button>
            <a href="<?php echo e(route('register')); ?>" class="btn">Еще не зарегистрированы? Регистрация</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>