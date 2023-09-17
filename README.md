# DocuVerse 

## Introduction

**DocuVerse**   *The Best Universal Document Management Solution*  :  This system, built in Laravel, efficiently manages your documents, with a specific focus on prefecture document management. It provides a user-friendly experience for managing your prefecture documents, along with a high level of security for tracking document permissions and a range of enhanced features.


## Features


1. **Authentication** : DocuVerse features a robust authentication system with the following functionalities

- User Registration
- User Login with Email Verification
- Password Reset
- Email Recovery
- Third-party Authentication Support:
    * Google
    * Facebook

2. **Authorization System** : DocuVerse offers a role-based authorization system with three roles

- **Owner** : Full control of the system .
- **Admin** : Administrative privileges with document and user management capabilities.
- **User** : Standard access for document management.

**Role Management**

- **Add Role**: create new roles to define access permissions.
- **Edit Role**: Modify existing roles to adapt to changing organizational needs.
- **Delete Role**: Remove unnecessary roles to maintain a streamlined system.
- **List Roles**: Easily view and manage all available roles in the system.
- **Assign Permissions**: Assign new permissions to roles, ensuring precise access control.


3. **User Management**

- **Add User**:  add new users to the system to expand your user base.
- **List Users**: Quickly retrieve an overview of all registered users for easy reference.
- **Edit User**: Modify user details and settings as needed to keep information up-to-date.
- **Delete User**: Remove user accounts when they beacame inactives
- **Activate User**: Activate user accounts to grant access to the system.
- **Deactivate User**: Temporarily disable user accounts while preserving their data.

4. **Management of Prefecture Clients**

- **Add New Client**: Easily add new clients to the prefecture management system.
- **Edit Client Info**: Update client information as needed to keep records accurate.
- **List All Clients**: Quickly access the list of all registered clients.
- **Drop Client**: Remove clients from the system when necessary.

5. **Manage section's prefectures**

- **Add New section**: Easily add new prefecture's section to the system.
- **Edit Section Info**: Modify prefecture's secion details for accuracy and updates.
- **List All sections**: Access the list of all registered prefectures's sections .
- **Delete section**: Remove unnecessary prefecture's section .

6. **Document Prefecture Management**

- **Add New Document**: Easily upload new documents to the prefecture system.
- **List All Documents**: Quickly access a comprehensive list of all registered documents.
- **Edit Existing Document**: Modify document details and content for accuracy and updates.
- **Delete Document**: Remove unnecessary documents.
- **Archive Document**: Archive documents for historical reference and organization.
- **View Document Details**: Examine document information to access essential details.
- **Export Documents**: Export all documents in Excel or PDF format for convenient sharing and reference.

7. **Manage Attachments to Documents**

- **Attach Multiple Files**: Easily link multiple attachments to a document for comprehensive information.
- **View Attachments**: Examine attachments individually for quick reference.
- **Download Attachments**: Download attachments to your local device for offline access.
- **Delete Attachments**: Remove unnecessary attachments .
- **Rename Attachments**: Edit attachment names for clarity and organization.
- **Edit Attachment Details**: Update attachment information for accuracy and relevance.

8. **Accessing Document Archive**

- **Restore Document**: Easily recover documents from the archive when needed.
- **Delete Document**: Permanently remove documents from the archive to free up space and resources.

9. **Report Section**

- **Search by Name**: Quickly find documents by searching for their names.
- **Filter by Document Section/Date**: Narrow down your search by specifying the document section or/and creation date.


10. **User Profile Management**

- **View Profile Details**: Easily access and review your profile information.
- **Edit Profile Information**: Update your profile details to keep them accurate and up-to-date.
- **Add Profile Picture**: Personalize your account by uploading a profile picture.
- **Change Password**: Enhance your account security by changing your password.
- **Delete Your Account**: If necessary, remove your account while preserving data privacy.

11. **Dashboard Section**

- **Consult Essential Statistics**: Access crucial statistics, including the total number of clients and monthly client statistics, as well as document and monthly document statistics.
- **View Latest Clients**: Stay updated with the latest client information.
- **Visualize Trends**:
  - **Bar Charts**: Gain insights at a glance with two bar charts showcasing document section trends.
  - **Circle Diagram**: Explore data with a dynamic circle diagram illustrating the distribution of documents across three key sections.

## Getting Started

1. Clone the repository: `git clone https://github.com/hkoutar7/Documents_managment_sytem.git my_proj` then  `cp my_proj`
2. Install dependencies: `composer install`
3. Install  js run time enviornment: `npm install` `npm run build`
4. Create .env file based on .env.example : `cp .env.example .env` 
5. Configure settings in `.env`
6. Run migration and seeder files : `php artisan mi:f --seed`
7. create a unique key :  `php artisan key:generate`
8. Run the app: `php artisan ser`
9. Access the app through your browser: `http://localhost:8000`
10. logged in the owner session then create 2 roles : Admin ,User

## Acknowledgments

I want to express my gratitude to everyone who supported me throughout the development of This project. Your encouragement and insights have been invaluable in shaping this accomplishment.

## Stay Updated

Stay tuned for upcoming developments in our project aimed at enhancing your document management experience at the prefecture. Join us on this journey as we collaborate to redefine the future of document management through innovative solutions. Together, we'll shape a more efficient and secure way to handle prefectural documents, streamlining processes and ensuring data integrity.


## Authors

- [hkoutar7](https://github.com/hkoutar7)

## Technologies used :


[![My Skills](https://skillicons.dev/icons?i=html,css,js,bootstrap,jquery,php,laravel,nodejs,mysql&perline=5)](https://skillicons.dev)
## Contributions

Contributions are welcome! If you find any issues or have ideas for improvements, feel free to submit issues and pull requests to enhance the project.
## Demo

in progress

