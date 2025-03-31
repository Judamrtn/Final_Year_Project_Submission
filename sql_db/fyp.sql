-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tuyishime evode', 'evodeholdingz@gmail.com', '$2y$10$wHeRn.Z2Lvye74bKDy7gU.tITcUyYtSNzjE.AbTMZjeCZPSgVmiyK', NULL, '2025-03-06 16:18:43', '2025-03-06 16:18:43'),
(2, 'tuyishime evode', 'evodeh@gmail.com', '$2y$10$7U4B2gRln6N9TyqBD3evZ.TH1WS1vWV9jjAqp1..61JmYWTsEuyBG', NULL, '2025-03-06 17:40:41', '2025-03-06 17:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `CampusId` varchar(255) NOT NULL,
  `CampusName` varchar(255) NOT NULL,
  `FacultyCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentCode` varchar(255) NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `StudentRegNumber` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentCode`, `DepartmentName`, `StudentRegNumber`, `created_at`, `updated_at`) VALUES
('D001', 'Computer Science', '22RP08440', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyCode` varchar(255) NOT NULL,
  `FacultyName` varchar(255) NOT NULL,
  `DepartmentCode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2025_03_03_064308_create_students_table', 2),
(9, '2025_03_05_165821_create_departments_table', 2),
(10, '2025_03_05_165827_create_faculties_table', 2),
(11, '2025_03_05_165832_create_projects_table', 2),
(12, '2025_03_05_165838_create_supervisors_table', 2),
(13, '2025_03_05_165844_create_campuses_table', 2),
(14, '2025_03_05_205310_add_student_reg_number_to_projects_table', 3),
(15, '2025_03_06_180027_create_admins_table', 3),
(16, '2025_03_06_200903_add_supervisor_email_to_projects_table', 4),
(17, '2025_03_06_210158_add_supervisor_email_foreign_to_projects_table', 5),
(18, '2025_03_06_221021_make_projectcode_nullable_in_supervisors_table', 6),
(19, '2025_03_06_235710_add_password_to_supervisors_table', 7),
(20, '2025_03_07_101703_add__supervisor_email_to_students_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectCode` varchar(255) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `ProjectProblems` text NOT NULL,
  `ProjectSolutions` text NOT NULL,
  `ProjectAbstract` text NOT NULL,
  `ProjectDissertation` text NOT NULL,
  `ProjectSourceCodes` text NOT NULL,
  `DepartmentCode` varchar(255) NOT NULL,
  `StudentRegNumber` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `SupervisorEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectCode`, `ProjectName`, `ProjectProblems`, `ProjectSolutions`, `ProjectAbstract`, `ProjectDissertation`, `ProjectSourceCodes`, `DepartmentCode`, `StudentRegNumber`, `Status`, `created_at`, `updated_at`, `SupervisorEmail`) VALUES
('3', 'lockmate', 'uttjvgcfrhdjkgkgcjfcj\r\nxrkvjkgvkuhgjfjykgl', 'uttjvgcfrhdjkgkgcjfcj\r\nxrkvjkgvkuhgjfjykgl', 'uttjvgcfrhdjkgkgcjfcu\r\nxrkvjkgvkuhgjfjykgl', 'projects/dissertations/3_dissertation.docx', 'projects/source_codes/3_source_codes.zip', 'D001', '22RP08440', 'Approved', '2025-03-06 04:35:44', '2025-03-06 22:30:42', NULL),
('45', 'SMART TRASH CAN', 'gujehbdkbjbrkfrhbjfrg\r\nifuvefjlnfjkm;emfnljrnkfn4rf\r\nhfuejnfl4emfn,4ekfmke4', 'gujehbdkbjbrkfrhbjfrg\r\nifuvefjlnfjkm;emfnljrnkfn4rf\r\nhfuejnfl4emfn,4ekfmke4', 'gujehbdkbjbrkfrhbjfrg\r\nifuvefjlnfjkm;emfnljrnkfn4rf\r\nhfuejnfl4emfn,4ekfmke4', 'projects/dissertations/45_dissertation.docx', 'projects/source_codes/45_source_codes.zip', 'D001', '22rp08007', 'Pending', '2025-03-07 04:15:10', '2025-03-07 04:15:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentRegNumber` varchar(255) NOT NULL,
  `StudentFirstName` varchar(255) NOT NULL,
  `StudentLastName` varchar(255) NOT NULL,
  `StudentGender` enum('Male','Female','Other') NOT NULL,
  `StudentEmail` varchar(255) NOT NULL,
  `StudentPhoneNumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supervisor_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentRegNumber`, `StudentFirstName`, `StudentLastName`, `StudentGender`, `StudentEmail`, `StudentPhoneNumber`, `password`, `created_at`, `updated_at`, `supervisor_email`) VALUES
('22RP00098', 'NIYOGUSHIMWA', 'irving', 'Male', 'evodeholdiz@gmail.com', '0789827673', '$2y$10$DlVSe5GBAnyuUgGruABzd.VeR4777x33yFHw9FGP0JqbXRLGputcq', '2025-03-07 07:10:53', '2025-03-07 07:10:53', NULL),
('22rp08007', 'kai', 'Baptiste', 'Male', 'ishimwe111@gmail.com', '7898789123', '$2y$10$mu.A7uVpYW1YveGCIujiGed7MRuurdT.GQoKyCWjV3SPNo/xkTEuO', '2025-03-07 04:12:28', '2025-03-07 04:12:28', NULL),
('22rp08009', 'NIYOGUSHIMWA', 'habimana', 'Male', 'ishimwe@gmail.com', '0789823230', '$2y$10$os7QkE2RgxPhU2K6rZar6.HF/t.o5UVm2bcCjJhwZljMgHEQZVFdS', '2025-03-06 10:04:38', '2025-03-06 10:04:38', NULL),
('22RP08440', 'TUYISHIME', 'irving', 'Male', 'rahemurenzi1@gmail.com', '0789823238', '$2y$10$.SqEmA2le/rJElM/18HtTeK.lseUk7ktjcf0/lwX8v75pAkDTT4Z.', '2025-03-05 15:49:00', '2025-03-07 07:26:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `SupervisorEmail` varchar(255) NOT NULL,
  `SupervisorFirstName` varchar(255) NOT NULL,
  `SupervisorLastName` varchar(255) NOT NULL,
  `SupervisorPhoneNumber` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ProjectCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`SupervisorEmail`, `SupervisorFirstName`, `SupervisorLastName`, `SupervisorPhoneNumber`, `password`, `ProjectCode`, `created_at`, `updated_at`) VALUES
('janiyonsenga10@gmail.com', 'westbrook', 'Janvier', '12345623723', '$2y$10$TIy8/pJdFWTjdjHpQzsZvuq3kVIYjYKXwIJ2Dvw4jkUOiIle5R8mW', NULL, '2025-03-07 05:12:00', '2025-03-07 05:13:07'),
('janiyonsenga22@gmail.com', 'NIYONSENGA', 'Janvier', '1234567890', '$2y$10$xGOcuRfcvpxgyfzxrR26F.1tbFlZVr0gGEl1Xa8LjQxX5K35RTEI.', NULL, '2025-03-06 20:16:08', '2025-03-06 22:11:38'),
('janiyonsenga72@gmail.com', 'kyrie', 'irving', '12345623', '$2y$10$/EKCap2GhfAIGbZatkrgbuwNCCkWvm5/kVEP9ZP7yj5QFiNpQ9mr6', NULL, '2025-03-06 22:15:32', '2025-03-06 22:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`CampusId`),
  ADD KEY `campuses_facultycode_foreign` (`FacultyCode`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentCode`),
  ADD KEY `departments_studentregnumber_foreign` (`StudentRegNumber`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`FacultyCode`),
  ADD KEY `faculties_departmentcode_foreign` (`DepartmentCode`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectCode`),
  ADD KEY `projects_departmentcode_foreign` (`DepartmentCode`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentRegNumber`),
  ADD UNIQUE KEY `students_studentemail_unique` (`StudentEmail`),
  ADD UNIQUE KEY `students_studentphonenumber_unique` (`StudentPhoneNumber`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`SupervisorEmail`),
  ADD KEY `supervisors_projectcode_foreign` (`ProjectCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `campuses`
--
ALTER TABLE `campuses`
  ADD CONSTRAINT `campuses_facultycode_foreign` FOREIGN KEY (`FacultyCode`) REFERENCES `faculties` (`FacultyCode`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_studentregnumber_foreign` FOREIGN KEY (`StudentRegNumber`) REFERENCES `students` (`StudentRegNumber`) ON DELETE CASCADE;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_departmentcode_foreign` FOREIGN KEY (`DepartmentCode`) REFERENCES `departments` (`DepartmentCode`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_departmentcode_foreign` FOREIGN KEY (`DepartmentCode`) REFERENCES `departments` (`DepartmentCode`) ON DELETE CASCADE;

--
-- Constraints for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD CONSTRAINT `supervisors_projectcode_foreign` FOREIGN KEY (`ProjectCode`) REFERENCES `projects` (`ProjectCode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
