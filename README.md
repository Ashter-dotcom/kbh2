![Uptime Robot ratio (30 days)](https://img.shields.io/uptimerobot/ratio/m788729160-6e3748157e94a0e22b10f3bf)

# SiLCEV 2022

Sistem informasi **SiLCEV 2022** merupakan sistem yang dibangun untuk pendataan produksi kendaraan roda empat yang tergolong mewah sebagai skrining dalam program diskon PPnBM-DTP, proyek ini terselenggara atas kerja sama antara PT. Surveyor Indonesia dengan PT. Optima Media Teknologi.

## Requirements

Persyaratan perangkat keras dan perangkat lunak untuk server **SiLCEV 2022**, spesifikasi server tentunya bergantung pada besarnya data yang tersimpan pada database dan jumlah pengunjung secara bersamaan, pada hal ini kita berpegangan pada kesepakatan awal dengan kemungkinan jumlah data dan perkiraan jumlah pengunjung yang sudah disepakati.

### Hardware

Kebutuhan minimal perangkat keras (atau yang setara) :

-   Processor 4 Cores
-   RAM 8 GB
-   Disk Space 50 GB

### Software

Kebutan perangkat lunak (atau yang serupa) :

-   Operating Sistem (OS) Ubuntu 20.04 LTS
-   Web Server Nginx (v1.21)
-   Database MariaDB (v10.4)
-   Bahasa Pemrograman PHP (v7.4)
-   Framework Laravel (v8.50)
-   Composer (v1.10.1)
-   PHP Extension Zip

### 3rd Party

Kebutuhan aplikasi pihak ketiga pendukung :

-   Newrelic
    Monitoring sistem untuk infrastruktur host dan aplikasi sistem - Infrastruktur Host :
    ` curl -Ls https://download.newrelic.com/install/newrelic-cli/scripts/install.sh | bash && sudo NEW_RELIC_API_KEY=NRAK-KI40QB3MD9363DY81JZ67TQ51ZK NEW_RELIC_ACCOUNT_ID=3227179 /usr/local/bin/newrelic install ` - Sistem Aplikasi :
    ` curl -Ls https://download.newrelic.com/install/newrelic-cli/scripts/install.sh | bash && sudo NEW_RELIC_API_KEY=NRAK-KI40QB3MD9363DY81JZ67TQ51ZK NEW_RELIC_ACCOUNT_ID=3227179 /usr/local/bin/newrelic install -n php-agent-installer `

-   Sentry :
    Monitoring sistem untuk _error log_
    ` DSN : https://03f269a5f95249cc9dc909ea54444b7a@sentry.optimap.id/15 `
-   UptimeRobot :
    Monitoring sistem untuk uptime pada halaman [ini](https://stats.uptimerobot.com/n8mW0UGQLq)
    ` https://stats.uptimerobot.com/n8mW0UGQLq `

## Installation

Langkah instalasi setelah _cloning source code_ dari sumber _versioning control_ :

1. Instal dependensi, jalankan perintah ini melalui terminal dari _root directory_ hasil _cloning_

    ```
    composer install
    ```

2. Sesuaikan berkas environment pada berkas `.env`

    - Copy berkas `.env.example` menjadi `.env` dengan perintah

    ```
    cp .env.example .env
    ```

    - Ubah env menjadi production pada berkas `.env`

    ```
    APP_ENV=production
    ```

    - Ubah DEBUG menjadi `false` ketika mode production pada berkas `.env`

    ```
    APP_DEBUG=false
    ```

    - Ubah BaseURL sesuai domain yang digunakan pada berkas `.env`

    ```
    APP_URL=http://localhost
    ```

    - Ubah konfigurasi database pada berkas `.env` sesuai dengan yang sudah terinstall

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=user_database
    DB_PASSWORD=sandi_database
    ```

    - Ubah konfigurasi error log sentry pada berkas `.env`

    ```
    SENTRY_LARAVEL_DSN=https://03f269a5f95249cc9dc909ea54444b7a@sentry.optimap.id/15
    SENTRY_ENVIRONMENT=production
    SENTRY_RELEASE=v0.1.0
    SENTRY_TRACES_SAMPLE_RATE=1
    ```

3. Generate App Key

    ```
    php artisan key:generate
    ```

4. Migrate database

    ```
    php artisan migrate
    ```

5. Seed database

    - Add Account

        ```
        php artisan db:seed --class=AccountSeeder
        ```

    - Add Komponen Data

        ```
        php artisan db:seed --class=KomponenSeeder
        ```

## Dummy Account

1. Superadmin

    ```
    Username : superadmin@dummy.com
    Password : QWEasd!@#123
    ```

2. Kementerian Perindustrian

    ```
    Username : kemenperin@dummy.com
    Password : lcev2022
    ```

3. Admin

    ```
    Username : admin@dummy.com
    Password : !@#123qweASD
    ```

4. Operator

    ```
    Username : operator@dummy.com
    Password : 123qweasd
    ```

5. Tenaga Ahli

    ```
    Username : ta@dummy.com
    Password : tappnbm
    ```
