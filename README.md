# saritaksi
 İnternet Programcılığı dönem sonu projesi olarak geliştirildi.

 Sitede kayıt olma ve giriş yapma işlemleri bulunmaktadır. Kayıt olan kullanıcıların şifreleri hashlenir ve güvenlik konusunda endişeleri giderilir.
 Ana sayfada ve eğer giriş yapılmışsa sağ üstte bulunan açılabilir seçenekler kısmı ile taksi çağırma fonksiyonu çalışır durumda.
 İletişim kısmında giriş yapmamış kullanıcıların bilgilerini doldurması beklenirken, giriş yapmış kullanıcıların bilgileri otomatik doldurulur ve sadece konuyu ve mesajı seçerek hızlı bir şekilde iletişime geçebilmelerine olanak tanınmıştır.
 Giriş yapan kullanıcılar için sağ üstten isimlerine tıkladıklarında `Şoför Ol` butonu ile şoför başvurusu formuna yönlendirilirler. Formu doldurup gönderen kullanıcılar şoförler sayfasında yerini alırken başka bir hesaptan taksi çağırıldığında şoför olarak atanırlar.
 Atanan şoför kullanıcıları sağ üstten isimlerine tıkladıklarında `Yolculuklarım` butonuna tıklayarak atandıkları yolculukları fiyat girerek tamamlayabilirler.
 Tamamlanan yolculuklar iki kullanıcının da `Yolculuklarım` kısmında gözükür.
 


# Kurulum Adımları

1. Projeyi github'dan klonlayın.

2. Composer kurun.
    >composer install

3. `env.example` dosyasını aynı yola açtığınız `.env` dosyasına kopyalayın.

4. `.env` dosyasını cihazınıza göre yapılandırın.

5. APP_KEY oluşturun.
    >php artisan key:generate

6. `config/database.php` dosyasını yapılandırın.

7. `storage\app\public` e link oluşturun.
    >php artisan storage:link

8. Uygulamayı başlatın.
