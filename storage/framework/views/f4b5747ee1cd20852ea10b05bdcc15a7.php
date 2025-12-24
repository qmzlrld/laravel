

<?php $__env->startSection('content'); ?>
<div class="grid two">
    <div class="card">
        <div class="section-title">
            <h1>Профиль</h1>
            <div class="tag">Данные пользователя</div>
        </div>
        <div class="grid">
            <div><strong>Логин:</strong> <?php echo e($user->login); ?></div>
            <div><strong>ФИО:</strong> <?php echo e($user->full_name); ?></div>
            <div><strong>Телефон:</strong> <?php echo e($user->phone); ?></div>
            <div><strong>Email:</strong> <?php echo e($user->email); ?></div>
        </div>
    </div>

    <div class="card">
        <div class="section-title">
            <h2>История заявок</h2>
            <div class="tag">Пагинация</div>
        </div>
        <?php if($bookings->count()): ?>
            <table>
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Гости</th>
                    <th>Статус</th>
                    <th>Комментарий</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($booking->reservation_at->format('d.m.Y H:i')); ?></td>
                        <td><?php echo e($booking->guests); ?></td>
                        <td><span class="pill <?php echo e($booking->status); ?>"><?php echo e($booking->status_label); ?></span></td>
                        <td><?php echo e($booking->comment ?: '—'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div style="margin-top: 12px;"><?php echo e($bookings->links()); ?></div>
        <?php else: ?>
            <p class="muted">Заявок пока нет.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\laravel\resources\views/profile.blade.php ENDPATH**/ ?>