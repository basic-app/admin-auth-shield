<?php
helper(['form']);
$this->setVar('title', lang('Admin.Control Panel'));
$this->setVar('description', lang('Admin.Sign in to continue.'));
?>
<?= $this->extend(config('Auth')->views['layout']);?>
<?= $this->section('main') ?>
    <form action="<?= url_to('login');?>" method="post">
        <?= csrf_field();?>
        <?= view_cell('AdminAuthInput', [
            'label' => lang('Auth.email'),
            'error' => session('errors')['email'] ?? null,
            'attributes' => [
                'type' => 'email',
                'name' => 'email',
                'placeholder' => lang('Auth.email'),
                'value' => set_value('email'),
                'inputmode' => 'email',
                'autocomplete' => 'email'
            ]
        ]);?>
        <?= view_cell('AdminAuthInput', [
            'label' => lang('Auth.password'),
            'error' => session('errors')['password'] ?? null,
            'attributes' => [
                'type' => 'password',
                'name' => 'password',
                'placeholder' => lang('Auth.password'),
                'value' => null,
                'inputmode' => 'text',
                'autocomplete' => 'current-password'
            ]
        ]);?>
        <!-- Remember me -->
        <?php if(setting('Auth.sessionConfig')['allowRemembering']): ?>
            <?= view_cell('AdminAuthCheckbox', [
                'label' => lang('Auth.rememberMe'),
                'error' => session('errors')['remember'] ?? null,
                'attributes' => [
                    'value' => 1,
                    'name' => 'remember',
                    'checked' => set_checkbox('remember', 1, true) ? true : false
                ]
            ]);?>
        <?php endif;?>
        <?= view_cell('AdminAuthSubmit', [
            'label' => lang('Admin.Sign In')
        ]);?>
    </form>
<?= $this->endSection();?>
