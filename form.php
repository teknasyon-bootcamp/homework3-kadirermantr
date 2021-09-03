<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */

class Form {
    public array $fields = [];

    // Varsayılan construct fonksiyonu
    private function __construct(
        public string $action,
        public string $method,
    ) {}

    // Post formu olusturan fonksiyon
    public static function createPostForm(string $action): Form
    {
        return self::createForm($action, 'POST');
    }

    // Get formu olusturan fonksiyon
    public static function createGetForm(string $action): Form
    {
        return self::createForm($action, 'GET');
    }

    // Form olusturan fonksiyon
    public static function createForm(string $action, string $method): Form
    {
        return new Form($action, $method);
    }

    // Degerleri diziye ekleyen fonksiyon
    public function addField(string $label, string $name, string $defaultValue = null): void
    {
        $field = [
            "label" => $label,
            "name"  => $name,
            "value" => $defaultValue,
        ];

        $this->fields[] = $field;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    // HTML cıktısını gosteren fonksiyon
    public function render(): void
    {
        echo "<form action='$this->action' method='$this->method'>" . PHP_EOL;

        foreach ($this->fields as $field)
        {
            echo  "\t<label for='".$field["name"]."'>".$field["label"]."</label>" . PHP_EOL;
            echo "\t<input type='text' name='".$field["name"]."' value='".$field["value"]."' />" . PHP_EOL;
            echo " ";
        }

        echo "\t<button type='submit'>Gönder</button>" . PHP_EOL;
        echo "</form>" . PHP_EOL;
    }
}