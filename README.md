# 🌿 GreenLife Wellness Center Web Application

## **📸 Screenshots**
<img width="811" height="1096" alt="image" src="https://github.com/user-attachments/assets/7c37a899-e1cd-4b27-87cf-0212f481b79f" />
<br>
<img width="1188" height="952" alt="image" src="https://github.com/user-attachments/assets/f7b50e15-30f8-4689-878d-04d6a699b305" />
<br>
<img width="1188" height="952" alt="image" src="https://github.com/user-attachments/assets/ed80a291-b8db-4748-abbe-4def3e050416" />
<br>
<img width="826" height="1367" alt="image" src="https://github.com/user-attachments/assets/500cadae-d0db-4e90-a5c2-5faf7fbdfff2" />
<br>
<img width="1072" height="1068" alt="image" src="https://github.com/user-attachments/assets/778e58ab-2879-411a-b13c-b166546b8151" />
<br>
<img width="1072" height="1068" alt="image" src="https://github.com/user-attachments/assets/61337c8d-a45e-4814-a5ba-e582bb2929b5" />
<br>
<img width="1072" height="1069" alt="image" src="https://github.com/user-attachments/assets/b28244ec-377e-462f-822a-72e49d9e7182" />
<br>
<img width="1072" height="961" alt="image" src="https://github.com/user-attachments/assets/5f9b99f1-0dd5-4220-a95a-b3044bd36acb" />
<br>
<img width="1179" height="935" alt="image" src="https://github.com/user-attachments/assets/870da670-e992-4676-a91a-46d409dd9bc0" />
<br>
<img width="1182" height="1058" alt="image" src="https://github.com/user-attachments/assets/4adb4f6a-1791-4420-b59d-3481e899317a" />
<br>

## 🛠️ Setup Instructions

Follow these steps to set up and run the GreenLife Wellness Center web application on your local machine:

### 1. Move Application Folder

Copy the project folder to your local WAMP server:

```
C:\wamp64\www\GreenLife Wellness Center
```

### 2. Import the Database

Import the provided SQL file into **phpMyAdmin**:

1. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Create a new database named: `greenlife_db`
3. Select the database → Go to the **SQL** tab
4. Paste the contents of the `greenlife_db.sql` file
5. Click **Go**

### 3. Launch the Application

Visit the app in your browser:

[http://localhost/GreenLife%20Wellness%20Center](http://localhost/GreenLife%20Wellness%20Center)

---

## 🗃️ Database Schema

### 📁 `greenlife_db`

---

### 📅 `appointments`

| Field             | Type        | Description                        |
|------------------|-------------|------------------------------------|
| appointment_id    | INT (PK)    | Auto-incrementing primary key      |
| client_id         | INT         | Foreign key to `users`             |
| therapist_id      | INT         | Foreign key to `users`             |
| service_id        | INT         | Foreign key to `services`          |
| appointment_date  | DATE        | Date of appointment                |
| appointment_time  | TIME        | Time of appointment                |
| status            | VARCHAR(10) | Status (`pending`, `confirmed`, etc.) |
| created_at        | TIMESTAMP   | Time of booking                    |

#### Sample Records

```sql
INSERT INTO appointments (...) VALUES
(17, 1, 28, 1, '2025-06-17', '22:55:00', 'cancelled', '2025-06-18 20:03:16'),
(16, 1, 28, 5, '2025-06-19', '01:29:00', 'confirmed', '2025-06-18 19:59:39'),
(15, 25, 27, 4, '2025-07-01', '10:00:00', 'pending', '2025-06-18 19:04:15'),
(14, 1, 3, 4, '2025-06-17', '12:31:00', 'confirmed', '2025-06-17 17:56:18');
```

---

### 📨 `inquiries`

| Field            | Type         | Description                         |
|------------------|--------------|-------------------------------------|
| inquiry_id       | INT (PK)     | Auto-incrementing primary key       |
| client_name      | VARCHAR(100) | Name of the client                  |
| client_email     | VARCHAR(100) | Email of the client                 |
| subject          | VARCHAR(255) | Subject of the inquiry              |
| message          | TEXT         | Inquiry message                     |
| therapist_reply  | TEXT         | Therapist's response (nullable)     |
| status           | VARCHAR(10)  | `open` or `closed`                  |
| submitted_at     | TIMESTAMP    | Time of submission                  |

---

### 🧘 `services`

| Field         | Type          | Description                         |
|---------------|---------------|-------------------------------------|
| service_id    | INT (PK)      | Auto-incrementing primary key       |
| service_name  | VARCHAR(100)  | Name of the wellness service        |
| description   | TEXT          | Description of the service          |
| image_path    | VARCHAR(255)  | Path to service image               |

#### Example Services:

- Nutrition and Diet Consultation
- Physiotherapy
- Yoga & Meditation
- Ayurvedic Therapy
- Massage Therapy

---

### 👤 `users`

| Field       | Type          | Description                          |
|-------------|---------------|--------------------------------------|
| user_id     | INT (PK)      | Auto-incrementing primary key        |
| full_name   | VARCHAR(100)  | Full name of the user                |
| email       | VARCHAR(100)  | Unique email address                 |
| password    | VARCHAR(255)  | Hashed password (bcrypt)             |
| role        | VARCHAR(10)   | `client`, `admin`, or `therapist`    |
| created_at  | TIMESTAMP     | Timestamp of account creation        |

> 💡 **Note:** Passwords are stored securely using bcrypt hashing.

---

## ✅ Status

- ✅ Database: Set up and seeded
- ✅ Admin Panel: Included
- ✅ Authentication: Functional
- ✅ Appointment System: Working
- ✅ Inquiry Form: Fully integrated

---

## 📎 Repository Info 

| Key               | Value                                            |
|-------------------|--------------------------------------------------|
| **Repository Name** | `GreenLife_Wellness_Center`                    |
| **Description**     | A PHP-MySQL wellness center web system featuring appointments, user roles, and inquiry management.

---
