### Инструкция по развертыванию

#### Требование минимальный LAMPP
- Веб сервер: Apache/Nginx
- PHP 7.3 или выше
- СУБД: MySQL\PostgreSQL

#### Если имеется Docker то запускаем комунду
`docker compose up -d`

#### Для работы с консольным приложением открываем консоль контейнера
`docker exec -it be_app sh` где `be_app` название контейнера
команда `php ./monolith/artisan notify:purchase`
```
 Tell me about customer! Hint his email:
 > {Тут вводим электронную почту клиента}
 
 Дальше спрашивает по какому заказу отправить уведоление
 
 Select which order you would like notify about!:
  [0] 5
  [1] 17
  [2] 29
  
  Дальше: Выбираем канал уведомление 
  nexmo = На номер телефона(SMS)
  mail = На электронную почту 
  
  Which channel do you want to send?:
  [0] nexmo
  [1] mail
```
