<main class="page__main page__main--registration">
    <div class="container">
        <h1 class="page__title page__title--registration">Регистрация</h1>
    </div>
    <section class="registration container">
        <h2 class="visually-hidden">Форма регистрации</h2>
        <form class="registration__form form" action="#" method="post" enctype="multipart/form-data">
            <div class="form__text-inputs-wrapper">
                <div class="form__text-inputs">
                    <?php $emptyEmail = isset($errors['email']) ? 'form__input-section--error' : ''; ?>
                    <div class="registration__input-wrapper form__input-wrapper">
                        <label class="registration__label form__label" for="registration-email">Электронная почта <span class="form__input-required">*</span></label>
                        <div class="form__input-section <?= $emptyEmail ; ?>">
                            <input class="registration__input form__input" id="registration-email" type="email" name="email" placeholder="Укажите эл.почту"
                                   value="<?= htmlspecialchars(getPostVal('email')); ?>">
                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                            <div class="form__error-text">
                                <h3 class="form__error-title">Обязательное поле</h3>
                                <p class="form__error-desc"><?= $errors['email'] ; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php $emptyLogin = isset($errors['login']) ? 'form__input-section--error' : ''; ?>
                    <div class="registration__input-wrapper form__input-wrapper">
                        <label class="registration__label form__label" for="registration-login">Логин <span class="form__input-required">*</span></label>
                        <div class="form__input-section <?= $emptyLogin ; ?>">
                            <input class="registration__input form__input" id="registration-login" type="text" name="login" placeholder="Укажите логин"
                                   value="<?= htmlspecialchars(getPostVal('login')); ?>">
                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                            <div class="form__error-text">
                                <h3 class="form__error-title">Обязательное поле</h3>
                                <p class="form__error-desc"><?= $errors['login'] ; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php $emptyPassword = (isset($errors['password']) || isset($errors['passwordRepeatError'])) ? 'form__input-section--error' : ''; ?>
                    <div class="registration__input-wrapper form__input-wrapper">
                        <label class="registration__label form__label" for="registration-password">Пароль<span class="form__input-required">*</span></label>
                        <div class="form__input-section <?= $emptyPassword ; ?>">
                            <input class="registration__input form__input" id="registration-password" type="password" name="password" placeholder="Придумайте пароль">
                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                            <div class="form__error-text">
                                <h3 class="form__error-title">Обязательное поле</h3>
                                <?php if (isset($errors['password'])): ?>
                                <p class="form__error-desc"><?= $errors['password']; ?></p>
                                <?php elseif (isset($errors['passwordRepeatError'])): ?>
                                    <p class="form__error-desc"><?= $errors['passwordRepeatError']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php $emptyPasswordRepeat = (isset($errors['password-repeat']) || isset($errors['password-repeatError'])) ? 'form__input-section--error' : ''; ?>
                    <div class="registration__input-wrapper form__input-wrapper">
                        <label class="registration__label form__label" for="registration-password-repeat">Повтор пароля<span class="form__input-required">*</span></label>
                        <div class="form__input-section <?= $emptyPasswordRepeat ; ?>">
                            <input class="registration__input form__input" id="registration-password-repeat" type="password" name="password-repeat" placeholder="Повторите пароль">
                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                            <div class="form__error-text">
                                <h3 class="form__error-title">Обязательное поле</h3>
                                <?php if (isset($errors['password-repeat'])): ?>
                                    <p class="form__error-desc"><?= $errors['password-repeat']; ?></p>
                                <?php elseif (isset($errors['password-repeatError'])): ?>
                                    <p class="form__error-desc"><?= $errors['password-repeatError']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="form__invalid-block">
                        <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                        <ul class="form__invalid-list">
                            <?php isset($errors['userpic-file']) ? $err_userpic = $errors['userpic-file'] :'';?>
                            <?= isset($errors['email']) ? '<li class="form__invalid-item">Заполните корректный адрес электронной почты</li>' : ''; ?>
                            <?= isset($errors['login']) ? '<li class="form__invalid-item">Заполните логин</li>' : ''; ?>
                            <?= (isset($errors['password']) || isset($errors['password-repeat'])) ? '<li class="form__invalid-item">Заполните пароль</li>' : ''; ?>
                            <?= isset($errors['passwordRepeatError']) ? '<li class="form__invalid-item">Пароли не совпадают</li>' : ''; ?>
                            <?= isset($err_userpic) ? '<li class="form__invalid-item">' . $err_userpic . '</li>' : ''; ?>
                        </ul>
                    </div>
                <?php else: ?>
                <?php endif; ?>

            </div>
            <div class="registration__input-file-container form__input-container form__input-container--file">
                <div class="registration__input-file-wrapper form__input-file-wrapper">
                    <div class="registration__file-zone form__file-zone dropzone">
                        <input class="registration__input-file form__input-file" id="userpic-file" type="file" name="userpic-file" title=" ">
                        <div class="form__file-zone-text">
                            <span>Перетащите фото сюда</span>
                        </div>
                    </div>
                </div>
                <div class="registration__file form__file dropzone-previews">

                </div>
            </div>
            <button class="registration__submit button button--main" type="submit">Отправить</button>
        </form>
    </section>
</main>
