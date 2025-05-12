# 📝 Elevage Janssens Family Website – Cattery Website with CMS

**Elevage Janssens Family** is a modern and responsive website designed for a cat breeding business (cattery).  
It provides a clean and elegant online presence for showcasing available kittens, breeding cats, and general information about the cattery.

The project includes a lightweight, user-friendly **Content Management System (CMS)** that allows the site owner to manage content dynamically without technical knowledge.

## 🎯 Purpose

The goal of this project is to provide a professional, customizable, and easy-to-manage website for a cattery business.  
It allows the breeder to present their cats and kittens in an elegant way while managing content independently through an integrated CMS.  
This improves communication with potential adopters, enhances the brand’s credibility, and streamlines the day-to-day management of online information.

## ✨ Features

- 🐾 Beautiful homepage with welcome message and featured cats
- 📸 Gallery section for kittens, adult cats, and past litters
- 📝 CMS interface to add/edit/delete:
- 😻 Cats (with photos and details)
- 📬 Contact form
- 🌐 SEO-friendly structure and metadata
- 📱 Fully responsive design (mobile-first)

## 🧰 Technologies Used

- **Frontend**: Vue.js, Tailwind CSS, Schadcn-vue, FontAwesome, Lucide-Vue
- **Backend**: Laravel 11, Sqlite

## 📦 Installation

### 🔧 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and NPM

### 🚀 Getting Started

1. Clone this repository:

    ```bash
    git clone https://github.com/Hadrien-Janssens/elevage_janssens_family.git
    ```

2. Install PHP dependencies:

    ```bash
    cd elevage_janssens_family
    composer install
    ```

3. Install Node.js dependencies:

    ```bash
    npm install
    ```

4. Copy the .env.example file to create your .env file:

    ```bash
    cp .env.example .env
    ```

5. Configure your `.env` file with your **database**, **mailing** and **Admin Login** settings.

6. Generate the Laravel application key and the symbolic link:

    ```bash
    php artisan key:generate
    php artisan storage:link
    ```

7. Run the migrations to set up the database tables:

    ```bash
    php artisan migrate --seed
    ```

    > 💡 If you want fake data, go to `database/seeders/DatabaseSeeder.php` and uncomment all factories.

8. Start backend and frontend development server:

    ```bash
    npm run dev:all
    ```

9. Access the app with the provided URL.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details.
For any inquiries or licensing questions, please contact: hadrien.janssens7@gmail.com

## 👤 Author

- [Hadrien Janssens](https://github.com/Hadrien-Janssens)

## Previews

 <p>Home page desktop</p>
 <img src="https://github.com/Hadrien-Janssens/elevage_janssens_family/blob/main/public/img/screenshots/homepage_desktop.png?raw=true" alt="homepage desktop" width="300" />
<p>Home page mobile</p>
<img src="https://github.com/Hadrien-Janssens/elevage_janssens_family/blob/main/public/img/screenshots/homepage_mobile.png?raw=true" alt="homepage mobile" width="300" />
<p>Contact mobile</p>
<img src="https://github.com/Hadrien-Janssens/elevage_janssens_family/blob/main/public/img/screenshots/homepage_contact_mobile.png?raw=true" alt="contact mobile " width="300" />
<p>Kitten</p>
<img src="https://github.com/Hadrien-Janssens/elevage_janssens_family/blob/main/public/img/screenshots/kitten.png?raw=true" alt="kitten" width="300" />
