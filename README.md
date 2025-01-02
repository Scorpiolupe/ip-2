# saritaksi
 İnternet Programcılığı dönem sonu projesi olarak geliştirildi.

 Taksi çağırma sitemiz, kullanıcıların hızlı ve kolay bir şekilde en yakın taksiyi bulup çağırmasını sağlayan bir platform. Kullanıcı dostu, basit bir arayüz kullandım. Kullanıcılar hem anlık hem de ileri tarihli taksi rezervasyonlarını zahmetsizce gerçekleştirebilir.
 


# Kurulum Adımları

1. Projeyi github'dan klonlayın.

2. Composer kurun.
    >composer install

3. env.example dosyasını aynı yola açtığınız .env dosyasına kopyalayın.

4. `.env` dosyasını yapılandırın.

5. APP_KEY oluşturun.
    >php artisan key:generate

6. `config/database.php` dosyasını yapılandırın.

7. `storage\app\public` e link oluşturun.
    >php artisan storage:link

8. Uygulamayı başlatın.
