

<?php $__env->startSection('content'); ?>
<div class="grid two">
    <div class="card">
        <div class="section-title">
            <h1>Бронирование столика</h1>
            <div class="tag">Главная страница</div>
        </div>
        <?php if(auth()->guard()->check()): ?>
            <form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="grid">
                <?php echo csrf_field(); ?>
                <div class="grid two">
                    <div>
                        <label for="date">Дата</label>
                        <input type="date" id="date" name="date" value="<?php echo e(old('date')); ?>" min="<?php echo e(now()->toDateString()); ?>" required>
                        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="time">Время</label>
                        <input type="time" id="time" name="time" value="<?php echo e(old('time')); ?>" required>
                        <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="grid two">
                    <div>
                        <label for="guests">Количество гостей</label>
                        <input type="number" id="guests" name="guests" min="1" max="20" value="<?php echo e(old('guests', 2)); ?>" required>
                        <?php $__errorArgs = ['guests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="comment">Пожелания</label>
                        <textarea id="comment" name="comment" placeholder="Предпочтения по столу или времени"><?php echo e(old('comment')); ?></textarea>
                        <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" class="btn accent">Отправить заявку</button>
                    <span class="muted">Статус заявки: Новая → Администратор подтвердит или отменит</span>
                </div>
            </form>
            <script>
                // Set min date using client local time to avoid timezone mismatch
                (() => {
                    const input = document.getElementById('date');
                    if (!input) return;
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0');
                    const dd = String(today.getDate()).padStart(2, '0');
                    const iso = `${yyyy}-${mm}-${dd}`;
                    input.min = iso;
                    if (input.value && input.value < iso) {
                        input.value = iso;
                    }
                })();
            </script>
        <?php else: ?>
            <p class="muted">Для отправки заявки войдите или создайте аккаунт.</p>
            <div class="actions">
                <a class="btn accent" href="<?php echo e(route('login')); ?>">Войти</a>
                <a class="btn" href="<?php echo e(route('register')); ?>">Регистрация</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="section-title">
            <h2>Мои последние заявки</h2>
            <div class="tag">Последние 5</div>
        </div>
        <?php if(auth()->check() && $bookings->isNotEmpty()): ?>
            <table>
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Гости</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($booking->reservation_at->format('d.m.Y H:i')); ?></td>
                        <td><?php echo e($booking->guests); ?></td>
                        <td><span class="pill <?php echo e($booking->status); ?>"><?php echo e($booking->status_label); ?></span></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php elseif(auth()->check()): ?>
            <p class="muted">Заявок пока нет.</p>
        <?php else: ?>
            <p class="muted">Авторизуйтесь, чтобы увидеть ваши заявки.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\laravel\resources\views/home.blade.php ENDPATH**/ ?>