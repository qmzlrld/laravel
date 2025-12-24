

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="section-title">
        <h1>Панель администратора</h1>
        <div class="tag">Управление заявками</div>
    </div>
    <form method="GET" class="actions" style="margin-bottom: 14px;">
        <label for="status" style="color:var(--muted);">Фильтр по статусу</label>
        <select id="status" name="status" onchange="this.form.submit()" style="max-width: 180px;">
            <option value="">Все</option>
            <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php if($currentStatus === $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

    <?php if($bookings->count()): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Дата</th>
                <th>Гости</th>
                <th>Комментарий</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>#<?php echo e($booking->id); ?></td>
                    <td>
                        <div><strong><?php echo e($booking->user->full_name); ?></strong></div>
                        <div class="muted"><?php echo e($booking->user->phone); ?> · <?php echo e($booking->user->email); ?></div>
                    </td>
                    <td><?php echo e($booking->reservation_at->format('d.m.Y H:i')); ?></td>
                    <td><?php echo e($booking->guests); ?></td>
                    <td><?php echo e($booking->comment ?: '—'); ?></td>
                    <td><span class="pill <?php echo e($booking->status); ?>"><?php echo e($booking->status_label); ?></span></td>
                    <td>
                        <form action="<?php echo e(route('admin.bookings.updateStatus', $booking)); ?>" method="POST" class="actions">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <select name="status">
                                <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php if($booking->status === $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button type="submit" class="btn">Обновить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div style="margin-top: 12px;"><?php echo e($bookings->links()); ?></div>
    <?php else: ?>
        <p class="muted">Заявок пока нет.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\laravel\resources\views/admin/bookings.blade.php ENDPATH**/ ?>