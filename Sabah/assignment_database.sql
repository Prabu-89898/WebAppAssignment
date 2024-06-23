
CREATE DATABASE assignment_database;

USE assignment_database;

CREATE TABLE admins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE events (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  approved TINYINT(1) NOT NULL DEFAULT 0
);

-- Create relationships

-- None needed for this example, as there are no relationships between tables

-- Insert sample data

INSERT INTO admins (username, password) VALUES
  ('admin1', 'password123'),
  ('admin2', 'password456');

INSERT INTO events (name, description) VALUES
  ('Event 1', 'This is the first event'),
  ('Event 2', 'This is the second event'),
  ('Event 3', 'This is the third event');

  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(4, 'What is MMU Food Bank?', 'The MMU Food Bank is an initiative by SRC and SCC to provide essential food items to students, faculty, and staff at MMU Cyberjaya to address food insecurity and support the well-being of our community'),
(5, 'Why was the MMU Food Bank established?', 'The Food Bank was established to combat food insecurity within the MMU community, ensuring everyone has access to nutritious food'),
(6, 'Who benefits from the MMU Food Bank?', 'The beneficiaries include all members of the MMU community: students, faculty, and staff.'),
(7, 'What types of food items are provided?', 'Food boxes include instant noodles and pasta, canned food (chicken curry), condiments (chili sauce &amp; sweet soy sauce), biscuits, instant coffee, and juice boxes.'),
(8, 'Where to access the Food Bank?', 'The Food Bank is located at the Ibnu Sina clinic, which is on the lower ground floor of the STC building, beside the Career Connect office.'),
(9, 'Is the Food Bank currently open?', 'No, the Food Bank is not yet open as the venue is still under renovation. This promotional booth aims to raise awareness about the upcoming Food Bank.'),
(10, 'How can I contribute to the Food Bank?', 'You can contribute by donating food items or making monetary donations. Everything will be informed when the food bank is officially launched. All information will be updated through the Instagram page.'),
(11, 'Who manages the Food Bank?', 'The Food Bank is managed by the Student Representative Council (SRC), Student College Committee (SCC) and FAC volunteers. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_registers`
--

CREATE TABLE `new_registers` (
  `IC_Number` varchar(12) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Age` varchar(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone_Number` varchar(30) NOT NULL,
  `Email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_registers`
--

INSERT INTO `new_registers` (`IC_Number`, `Name`, `Age`, `Address`, `Phone_Number`, `Email`) VALUES
('121212345678', 'Thashana', '22', '308 negra arroyo lane', '0', 'thashanacool@gmail.com'),
('343434567890', 'Joe Mama', '54', 'Sessame Street', '0133427912', 'Mo_lester@Yahoo.mail'),
('545454678910', 'Prabu', '24', 'Subang SS15', '0111111999', 'prabu@gmai.com'),
('767676541919', 'Moe Lester', '45', 'Sessame Street', '0101000110', 'Mo_lester@Yahoo.mail'),
('888899999999', 'Joe Mama', '21', '123 negra arroyo lane', '1234567896', 'leandra.mann@accruenyc.co');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_registers`
--
ALTER TABLE `new_registers`
  ADD PRIMARY KEY (`IC_Number`);
COMMIT;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_users`
--

CREATE TABLE `new_users` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_users`
--

INSERT INTO `new_users` (`id`, `Name`, `email`, `password`) VALUES
(17, 'Brewbearz', 'Brew@gmail.com', '$2y$10$pwL367NYADvWoIecoP35w.sTwGfEQpplz4Fd2H70kPA'),
(20, 'Joe Mama', '1211102424@student.mmu.edu.my', '$2y$10$AtA7VPY.9VKA604xzNnh0eNdLOAMZ409.l18Y4N.m5b'),
(22, 'Prabu', 'prabu@gmai.com', '$2y$10$5.AHGMq2QuPDaefP8Wb/YO/BMh0myVf5w/6uqmzjVOC'),
(26, 'Leandra Mann', 'leandra.mann@accruenyc.com', '$2y$10$qRhva9uVy2Ys1Qa2TTXgTuPprMsVonUwT3957rLCz8a'),
(27, 'Moe Lester', 'Mo_lester@Yahoo.mail', '$2y$10$DtgjrltP1GPcpXlfJcJLAOjcAtMHj5NkjCgXw8RhYzZ'),
(28, 'Thashana', 'thashanacool@gmail.com', '$2y$10$JQ/QIVCK.n8W2HRc9gSoYuOVmfKOxzDVNkEPfx3YixU'),
(29, 'meme', 'meme@gmail.com', '$2y$10$2ZCO8.otQ1PodoS0W.8wy.jERqf1Zpya7ped1nQO/dX'),
(30, 'you', 'yu@gmail.com', '$2y$10$pr78MfGZm0jiEp/kY18aLucPoJpheBRETI6lB26tTcr'),
(32, 'admin', 'admin@gmail.com', '$2y$10$Y689MyIIlheVBFYCK6m6.O2gypoOeBg1d6t.S7ywMXm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_users`
--
ALTER TABLE `new_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_users`
--
ALTER TABLE `new_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suggestions`
--

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id`, `question`, `answer`, `created_at`) VALUES
(1, 'What is MMU Food Bank?', 'IDk whatever', '2024-06-23 16:32:09'),
(2, 'fefefgefwefwfw', 'vvgvvreververv', '2024-06-23 16:38:34'),
(3, 'Who benefits from the MMU Food Bank?', NULL, '2024-06-23 17:11:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

CREATE TABLE calendarevents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);

CREATE TABLE suggested_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);


INSERT INTO calendarevents (event_date, event_description) VALUES
('2024-07-01', 'Food Distribution Drive'),
('2024-07-15', 'Volunteer Appreciation Event'),
('2024-07-20', 'Community Kitchen Opening'),
('2024-08-05', 'Monthly Board Meeting'),
('2024-08-10', 'Fundraising Gala');

INSERT INTO suggested_events (event_date, event_description) VALUES
('2024-07-02', 'Nutrition Workshop'),
('2024-07-18', 'Food Safety Training'),
('2024-07-25', 'Charity Fun Run'),
('2024-08-07', 'Cooking Class for Volunteers'),
('2024-08-12', 'School Supply Drive');