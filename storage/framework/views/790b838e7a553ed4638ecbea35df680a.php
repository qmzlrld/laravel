

<?php $__env->startSection('content'); ?>
<div class="card" style="max-width: 620px; margin: 0 auto;">
    <div class="section-title">
        <h1>Регистрация</h1>
        <div class="tag">Все поля обязательны</div>
    </div>
    <form action="<?php echo e(route('register')); ?>" method="POST" class="grid two">
        <?php echo csrf_field(); ?>
        <div>
            <label for="login">Логин (латиница/цифры, от 6)</label>
            <input type="text" id="login" name="login" value="<?php echo e(old('login')); ?>" required minlength="6" pattern="[A-Za-z0-9]{6,}">
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
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="full_name">ФИО (кириллица)</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo e(old('full_name')); ?>" required>
            <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="phone">Телефон 8(XXX)XXX-XX-XX</label>
            <input type="text" id="phone" name="phone" placeholder="8(900)123-45-67" value="<?php echo e(old('phone')); ?>" required pattern="8\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}">
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label for="password">Пароль (мин. 8)</label>
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
        <div>
            <label for="password_confirmation">Повтор пароля</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
        </div>
        <div class="actions" style="grid-column: 1 / -1;">
            <button type="submit" class="btn accent">Создать пользователя</button>
            <a href="<?php echo e(route('login')); ?>" class="btn">Уже есть аккаунт? Войти</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>