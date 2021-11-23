<?php
var_dump($errors);
?>
<br>
<?php
var_dump($_POST);
?>


<main class="page__main page__main--adding-post">
    <div class="page__main-section">
        <div class="container">
            <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
        </div>
        <div class="adding-post container">

            <div class="adding-post__tabs-wrapper tabs">
                <div class="adding-post__tabs filters">
                    <ul class="adding-post__tabs-list filters__list tabs__list">

                    <?php foreach ($content_type_arr as $type): ?>
                        <li class="adding-post__tabs-item filters__item">
                            <a href="add.php?postTypeID=<?= $type['id']; ?>" class="adding-post__tabs-link filters__button filters__button--<?= $type['class_name']; ?>
                            <?= ($postTypeID === $type['id']) ? 'filters__button--active tabs__item--active tabs__item' : ''; ?>   button">
                                <svg class="filters__icon" width="22" height="18">
                                    <use xlink:href="#icon-filter-<?= $type['class_name']; ?>"></use>
                                </svg>
                                <span><?= $type['type_name']; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="adding-post__tab-content">
                    <section class="adding-post__photo tabs__content <?= ($postTypeID == 3) ? 'tabs__content--active' : ''; ?>">
                        <h2 class="visually-hidden">Форма добавления фото</h2>

                        <form class="adding-post__form form" action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="postTypeID" value="3">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="photo-heading">Заголовок <span class="form__input-required">*</span></label>


                                        <?php $classname = isset($errors['title']) ? 'form__input-section--error' : ''; ?>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="photo-heading" type="text" name="title" placeholder="Введите заголовок"
                                            value="<?= htmlspecialchars(getPostVal('title')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="photo-url">Ссылка из интернета</label>
                                        <div class="form__input-section">
                                            <input class="adding-post__input form__input" id="photo-url" type="text" name="image_link_web" placeholder="Введите ссылку"
                                                   value="<?= htmlspecialchars(getPostVal('image_link_web')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="photo-tags">Теги</label>
                                        <div class="form__input-section">
                                            <input class="adding-post__input form__input" id="photo-tags" type="text" name="hashtag" placeholder="Введите теги"
                                            value="<?= htmlspecialchars(getPostVal('hashtag')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__invalid-block">
                                    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                    <ul class="form__invalid-list">
                                        <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="adding-post__input-file-container form__input-container form__input-container--file">
                                <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                                    <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                                        <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="image_link" title=" ">
                                        <div class="form__file-zone-text">
                                            <span>Перетащите фото сюда</span>
                                        </div>
                                    </div>
                                    <button class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button" type="button">
                                        <span>Выбрать фото</span>
                                        <svg class="adding-post__attach-icon form__attach-icon" width="10" height="20">
                                            <use xlink:href="#icon-attach"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="adding-post__file adding-post__file--photo form__file dropzone-previews">

                                </div>
                            </div>
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit" name="task-btn">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__video tabs__content <?= ($postTypeID == 4) ? 'tabs__content--active' : ''; ?>">
                        <h2 class="visually-hidden">Форма добавления видео</h2>
                        <form class="adding-post__form form" action="add.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="postTypeID" value="4">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="video-heading" type="text" name="title" placeholder="Введите заголовок"
                                            value="<?= htmlspecialchars(getPostVal('title')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="video-url" type="text" name="video_link" placeholder="Введите ссылку"
                                            value="<?= htmlspecialchars(getPostVal('video_link')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="video-tags">Теги</label>
                                        <div class="form__input-section">
                                            <input class="adding-post__input form__input" id="video-tags" type="text" name="hashtag" placeholder="Введите ссылку"
                                            value="<?= htmlspecialchars(getPostVal('hashtag')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__invalid-block">
                                    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                    <ul class="form__invalid-list">
                                        <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__text tabs__content <?= ($postTypeID == 1) ? 'tabs__content--active' : ''; ?>">
                        <h2 class="visually-hidden">Форма добавления текста</h2>
                        <form class="adding-post__form form" action="add.php" method="post">
                            <input type="hidden" name="postTypeID" value="1">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="text-heading">Заголовок <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="text-heading" type="text" name="title" placeholder="Введите заголовок"
                                            value="<?= htmlspecialchars(getPostVal('title')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Обязательное поле</h3>
                                                <p class="form__error-desc">Заполните заголовок.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                                        <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <textarea class="adding-post__textarea form__textarea form__input" id="post-text" placeholder="Введите текст публикации" name="text"
                                            value="<?= htmlspecialchars(getPostVal('text')); ?>"></textarea>
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Обязательное поле</h3>
                                                <p class="form__error-desc">Заполните текст поста</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="post-tags">Теги</label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="post-tags" type="text" name="hashtag" placeholder="Введите теги"
                                            value="<?= htmlspecialchars(getPostVal('hashtag')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Обязательное поле</h3>
                                                <p class="form__error-desc">Напишите хотя бы один тег</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__invalid-block">
                                    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                    <ul class="form__invalid-list">
                                        <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                        <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__quote tabs__content <?= ($postTypeID == 2) ? 'tabs__content--active' : ''; ?>">
                        <h2 class="visually-hidden">Форма добавления цитаты</h2>
                        <form class="adding-post__form form" action="add.php" method="post">
                            <input type="hidden" name="postTypeID" value="2">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="quote-heading">Заголовок <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="quote-heading" type="text" name="title" placeholder="Введите заголовок"
                                            value="<?= htmlspecialchars(getPostVal('title')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__textarea-wrapper">
                                        <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" placeholder="Текст цитаты" name="text_quote"
                                            value="<?= htmlspecialchars(getPostVal('text_quote')); ?>"></textarea>
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__textarea-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="quote-author" type="text" name="author_quote"
                                            value="<?= htmlspecialchars(getPostVal('author_quote')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="cite-tags">Теги</label>
                                        <div class="form__input-section">
                                            <input class="adding-post__input form__input" id="cite-tags" type="text" name="hashtag" placeholder="Введите теги"
                                            value="<?= htmlspecialchars(getPostVal('hashtag')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__invalid-block">
                                    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                    <ul class="form__invalid-list">
                                        <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                        <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>

                    <section class="adding-post__link tabs__content <?= ($postTypeID == 5) ? 'tabs__content--active' : ''; ?>">
                        <h2 class="visually-hidden">Форма добавления ссылки</h2>
                        <form class="adding-post__form form" action="add.php" method="post">
                            <input type="hidden" name="postTypeID" value="5">
                            <div class="form__text-inputs-wrapper">
                                <div class="form__text-inputs">
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="link-heading">Заголовок <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="link-heading" type="text" name="title" placeholder="Введите заголовок"
                                            value="<?= htmlspecialchars(getPostVal('title')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__textarea-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
                                        <div class="form__input-section <?= $classname; ?>">
                                            <input class="adding-post__input form__input" id="post-link" type="text" name="site_link"
                                            value="<?= htmlspecialchars(getPostVal('site_link')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="adding-post__input-wrapper form__input-wrapper">
                                        <label class="adding-post__label form__label" for="link-tags">Теги</label>
                                        <div class="form__input-section">
                                            <input class="adding-post__input form__input" id="link-tags" type="text" name="hashtag" placeholder="Введите ссылку"
                                            value="<?= htmlspecialchars(getPostVal('hashtag')); ?>">
                                            <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                                            <div class="form__error-text">
                                                <h3 class="form__error-title">Заголовок сообщения</h3>
                                                <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form__invalid-block">
                                    <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                                    <ul class="form__invalid-list">
                                        <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                                        <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="adding-post__buttons">
                                <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
                                <a class="adding-post__close" href="#">Закрыть</a>
                            </div>
                        </form>
                    </section>
                </div>

            </div>

        </div>
    </div>
</main>
