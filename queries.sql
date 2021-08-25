INSERT INTO `content_type` (`type_name`, `class_name`)
VALUES  ('Текст', 'text'),
        ('Цитата', 'quote'),
        ('Картинка', 'photo'),
        ('Видео', 'video'),
        ('Ссылка', 'link');

INSERT INTO `users` (`email`, `login`, `password`, `avatar_link`)
VALUES  ('htmlacademy_larisa@gmail.com', 'Лариса', '1234556', 'userpic-larisa-small.jpg'),
        ('vladik_php@yandex.ru', 'Владик', '8675432', 'userpic.jpg'),
        ('viktor-191923@mail.ru', 'Виктор', '7683542', 'userpic-mark.jpg');

INSERT INTO `comments` (`comment_content`, `user_id`, `post_id`)
VALUES  ('Если вы знаете, что это такое, то у вас уже есть пенсионное удостоверение', '1', '1'),
        ('Кругом обман', '2', '2');

INSERT INTO `posts` (`title`, `text`, `text_quote`, `author_quote`, `image_link`, `video_link`, `site_link`, `views`, `user_id`, `content_type_id`, `hashtag_id`)
VALUES  ('Цитата', NULL, 'Мы в жизни любим только раз, а после ищем лишь похожих','Неизвестный Автор', NULL, NULL, NULL, '10', '1', '2', NULL),
        ('Игра престолов', 'Не могу дождаться начала финального сезона своего любимого сериала!
        Не могу дождаться начала финального сезона своего любимого сериала!
        Не могу дождаться начала финального сезона своего любимого сериала!
        Не могу дождаться начала финального сезона своего любимого сериала!
        Не могу дождаться начала финального сезона своего любимого сериала!
        Не могу дождаться начала финального сезона своего любимого сериала!', NULL, NULL, NULL, NULL, NULL, '15', '2', '1', NULL ),
       ('Наконец, обработал фотки!', NULL, NULL, NULL, 'rock-medium.jpg', NULL, NULL, '4', '3', '3', NULL),
       ('Моя мечта', NULL, NULL, NULL, 'coast-medium.jpg', NULL, NULL, '1', '1', '3', NULL),
       ('Лучшие курсы', NULL, NULL, NULL, NULL, NULL, 'www.htmlacademy.ru', '33', '2', '5', NULL);

/* получить список постов с сортировкой по популярности и вместе с именами авторов и типом контента; */
SELECT * FROM `posts` ORDER BY `posts`.`views` DESC;

/* получить список комментариев для одного поста, в комментариях должен быть логин пользователя; */
SELECT * FROM `posts` WHERE `user_id` = 1;

/* добавить лайк к посту; */
INSERT INTO `likes` (`user_id`, `post_id`)
VALUES  ('1', '2'),
        ('2', '1');

/* подписаться на пользователя. */
INSERT INTO `subscriptions` (`user_id_subscribed`, `user_id_subscribed_to`)
VALUES  ('2', '1'),
        ('3', '1');
