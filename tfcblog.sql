-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 08:22 AM
-- Server version: 8.0.22
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfcblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `body`, `created_at`) VALUES
(86, 63, 22, 'Esto es otro comentario de prueba.', '2021-05-18 16:35:42'),
(87, 63, 22, 'Comentario de prueba del post 19\n', '2021-05-18 16:35:52'),
(88, 110, 25, 'Comentario de prueba del post 16', '2021-05-18 16:36:20'),
(89, 110, 25, 'Comentario de prueba del post 25', '2021-05-18 16:36:32'),
(90, 111, 21, 'Comentario de prueba del post 21', '2021-05-18 16:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(8, 'Marty Mcfly', 'marty.mcfly@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit atque consectetur voluptas facere incidunt magni eaque, nobis, illum dicta dolore perferendis repellat? Hic numquam officiis quis qui excepturi, laborum voluptate veniam aut impedit illum eius fugiat. Sit ullam libero iure eum, nisi, accusantium quis quisquam cum enim rem architecto, corrupti similique eligendi reprehenderit cumque esse commodi laborum possimus harum incidunt! Ullam voluptas maxime excepturi quos, ipsa libero tempore tenetur repellat. Eum veniam ea, sit saepe temporibus sed asperiores incidunt quidem perspiciatis omnis labore voluptates maxime modi nostrum unde. Harum totam aspernatur tenetur, ut cum voluptas? Adipisci, beatae ut dolore cum ab aliquam ad iure corporis dolorem cupiditate. Officiis nesciunt, aut quisquam modi odio aliquid dolorum quod provident eos consectetur dolorem necessitatibus voluptas assumenda pariatur itaque quis nulla commodi accusamus impedit quos sed aliquam error illo eveniet! \r\n\r\nUnde mollitia totam deleniti cumque, incidunt minus nam tempore, neque placeat ea amet accusantium ipsum qui eaque cum sed perferendis dolorum suscipit, ullam aperiam. Aperiam sapiente obcaecati, optio accusamus corporis eaque. Perspiciatis aut itaque iure? Quis reprehenderit assumenda libero? Quidem eaque aspernatur fugit cupiditate facilis nulla id, aut aliquid. Quisquam quam velit hic debitis autem architecto sed quidem iure ex omnis neque beatae quos inventore aperiam possimus aut placeat accusamus cum saepe quasi at, ullam et. Cum similique cupiditate quidem fuga maxime quis iusto excepturi earum ratione veritatis, suscipit velit rem placeat perspiciatis nemo illo tempore explicabo in sapiente incidunt facere deleniti, inventore vero nobis. Nihil consequatur aperiam maxime molestias, qui doloremque ipsam quam autem architecto repellat, accusantium laudantium dignissimos assumenda nostrum, laboriosam optio voluptatibus illo iure itaque corporis sunt a?\r\n\r\nOptio odit repudiandae vel culpa, neque, corrupti ipsam deserunt natus facere accusamus temporibus aspernatur veniam. Ipsam libero vero accusantium voluptatum quis repudiandae et placeat, similique eos? At ex facere error repudiandae similique, consequuntur accusantium repellat, a debitis laudantium, voluptatibus ea veniam incidunt asperiores laboriosam adipisci fugiat. Voluptatum rem fugit quaerat ratione voluptates laborum, reiciendis iure porro accusantium voluptate sapiente ut pariatur illo, placeat praesentium eos, blanditiis in quae dolorum quisquam magni excepturi? Nisi, delectus? Quasi error, unde laboriosam suscipit minus dolorem minima. Impedit numquam accusantium architecto sunt molestias vitae aliquam ea sed eaque ducimus quaerat a animi possimus sequi veniam aut maiores corrupti, ipsum dolorem! Impedit, possimus accusantium corporis quod maiores totam ipsam fuga dolore, sunt praesentium pariatur placeat saepe? Adipisci maiores animi, unde veniam eos fugit perferendis consequatur architecto reprehenderit. Ipsum laborum a sit, maxime quia deserunt itaque aliquid facere quis, praesentium atque doloremque architecto aut repellendus fugit neque dolore aliquam. Modi delectus impedit aut, ipsam esse laborum ipsa quisquam sunt ratione corrupti maiores ut ad? Totam sint quo numquam, similique distinctio eos iste ad voluptatum perferendis reprehenderit excepturi, veniam quae.\r\n\r\n', '2021-05-19 08:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `topic_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `published` tinyint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `body`, `published`, `created_at`) VALUES
(19, 63, 16, 'Los alienígenas vuelven a la carga', '1620920079_El gaaaaaaaaaaaancho.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit atque consectetur voluptas facere incidunt magni eaque, nobis, illum dicta dolore perferendis repellat? Hic numquam officiis quis qui excepturi, laborum voluptate veniam aut impedit illum eius fugiat. Sit ullam libero iure eum, nisi, accusantium quis quisquam cum enim rem architecto, corrupti similique eligendi reprehenderit cumque esse commodi laborum possimus harum incidunt! Ullam voluptas maxime excepturi quos, ipsa libero tempore tenetur repellat. Eum veniam ea, sit saepe temporibus sed asperiores incidunt quidem perspiciatis omnis labore voluptates maxime modi nostrum unde. Harum totam aspernatur tenetur, ut cum voluptas? Adipisci, beatae ut dolore cum ab aliquam ad iure corporis dolorem cupiditate. Officiis nesciunt, aut quisquam modi odio aliquid dolorum quod provident eos consectetur dolorem necessitatibus voluptas assumenda pariatur itaque quis nulla commodi accusamus impedit quos sed aliquam error illo eveniet!&nbsp;</p><p>Unde mollitia totam deleniti cumque, incidunt minus nam tempore, neque placeat ea amet accusantium ipsum qui eaque cum sed perferendis dolorum suscipit, ullam aperiam. Aperiam sapiente obcaecati, optio accusamus corporis eaque. Perspiciatis aut itaque iure? Quis reprehenderit assumenda libero? Quidem eaque aspernatur fugit cupiditate facilis nulla id, aut aliquid. Quisquam quam velit hic debitis autem architecto sed quidem iure ex omnis neque beatae quos inventore aperiam possimus aut placeat accusamus cum saepe quasi at, ullam et. Cum similique cupiditate quidem fuga maxime quis iusto excepturi earum ratione veritatis, suscipit velit rem placeat perspiciatis nemo illo tempore explicabo in sapiente incidunt facere deleniti, inventore vero nobis. Nihil consequatur aperiam maxime molestias, qui doloremque ipsam quam autem architecto repellat, accusantium laudantium dignissimos assumenda nostrum, laboriosam optio voluptatibus illo iure itaque corporis sunt a?</p><p>Optio odit repudiandae vel culpa, neque, corrupti ipsam deserunt natus facere accusamus temporibus aspernatur veniam. Ipsam libero vero accusantium voluptatum quis repudiandae et placeat, similique eos? At ex facere error repudiandae similique, consequuntur accusantium repellat, a debitis laudantium, voluptatibus ea veniam incidunt asperiores laboriosam adipisci fugiat. Voluptatum rem fugit quaerat ratione voluptates laborum, reiciendis iure porro accusantium voluptate sapiente ut pariatur illo, placeat praesentium eos, blanditiis in quae dolorum quisquam magni excepturi? Nisi, delectus? Quasi error, unde laboriosam suscipit minus dolorem minima. Impedit numquam accusantium architecto sunt molestias vitae aliquam ea sed eaque ducimus quaerat a animi possimus sequi veniam aut maiores corrupti, ipsum dolorem! Impedit, possimus accusantium corporis quod maiores totam ipsam fuga dolore, sunt praesentium pariatur placeat saepe? Adipisci maiores animi, unde veniam eos fugit perferendis consequatur architecto reprehenderit. Ipsum laborum a sit, maxime quia deserunt itaque aliquid facere quis, praesentium atque doloremque architecto aut repellendus fugit neque dolore aliquam. Modi delectus impedit aut, ipsam esse laborum ipsa quisquam sunt ratione corrupti maiores ut ad? Totam sint quo numquam, similique distinctio eos iste ad voluptatum perferendis reprehenderit excepturi, veniam quae.</p><p>Dolores repellendus officiis minus, nesciunt doloribus delectus optio ipsum aliquid dolor neque mollitia quidem commodi consequuntur. Rerum impedit dolore at. Delectus molestias, possimus, incidunt velit impedit eius debitis aliquam quisquam molestiae ea natus voluptate voluptatum! Vel laudantium exercitationem aliquam. Hic, nam eos perspiciatis eum saepe nulla odit quis in libero sequi pariatur quidem quasi facere! Qui explicabo ratione nisi quam repellendus est iure nam minima. Voluptates odio blanditiis nisi mollitia tenetur libero eius, nesciunt eaque inventore deleniti. Corporis qui voluptate perferendis error possimus voluptates ipsam! Quis ad optio unde, ipsam voluptatibus accusantium numquam saepe minus tempore eveniet asperiores quaerat eaque, minima natus quae culpa pariatur delectus repellat perferendis distinctio aliquam! Obcaecati sed ea ipsam, eaque veritatis dolor aliquid sunt! Maxime ad cupiditate nam excepturi blanditiis! Possimus minima fugiat veritatis similique, aliquam recusandae modi magnam blanditiis voluptatibus natus corporis impedit dolores iure dolor repellat officia laudantium voluptatum temporibus rem. Dolore nesciunt vel illum dolor reiciendis incidunt recusandae amet magnam consectetur ducimus. Soluta vero in tenetur culpa provident mollitia, eos nemo beatae saepe unde maxime suscipit et incidunt architecto dignissimos aut velit modi voluptatibus, consequatur repellat dolor nulla ipsum autem illo? Suscipit adipisci, iste fugiat, fuga, deserunt laboriosam accusantium consectetur magnam maiores incidunt aperiam illum hic neque? Quos, mollitia in repellat, asperiores nisi consequatur saepe provident ipsam incidunt dolor repellendus, iure exercitationem reiciendis accusantium iste laudantium quam corrupti vero? Reiciendis, libero voluptatibus, quibusdam aliquid ipsam necessitatibus magni qui suscipit eaque quos esse, in natus expedita quam nulla aperiam repellat fuga et rem quae!</p>', 1, '2021-05-13 17:34:39'),
(20, 63, 16, 'Buzz y Woody por fin hacen las paces', '1620920163_toy-story-1.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit atque consectetur voluptas facere incidunt magni eaque, nobis, illum dicta dolore perferendis repellat? Hic numquam officiis quis qui excepturi, laborum voluptate veniam aut impedit illum eius fugiat. Sit ullam libero iure eum, nisi, accusantium quis quisquam cum enim rem architecto, corrupti similique eligendi reprehenderit cumque esse commodi laborum possimus harum incidunt! Ullam voluptas maxime excepturi quos, ipsa libero tempore tenetur repellat. Eum veniam ea, sit saepe temporibus sed asperiores incidunt quidem perspiciatis omnis labore voluptates maxime modi nostrum unde. Harum totam aspernatur tenetur, ut cum voluptas? Adipisci, beatae ut dolore cum ab aliquam ad iure corporis dolorem cupiditate. Officiis nesciunt, aut quisquam modi odio aliquid dolorum quod provident eos consectetur dolorem necessitatibus voluptas assumenda pariatur itaque quis nulla commodi accusamus impedit quos sed aliquam error illo eveniet!&nbsp;</p><p>Unde mollitia totam deleniti cumque, incidunt minus nam tempore, neque placeat ea amet accusantium ipsum qui eaque cum sed perferendis dolorum suscipit, ullam aperiam. Aperiam sapiente obcaecati, optio accusamus corporis eaque. Perspiciatis aut itaque iure? Quis reprehenderit assumenda libero? Quidem eaque aspernatur fugit cupiditate facilis nulla id, aut aliquid. Quisquam quam velit hic debitis autem architecto sed quidem iure ex omnis neque beatae quos inventore aperiam possimus aut placeat accusamus cum saepe quasi at, ullam et. Cum similique cupiditate quidem fuga maxime quis iusto excepturi earum ratione veritatis, suscipit velit rem placeat perspiciatis nemo illo tempore explicabo in sapiente incidunt facere deleniti, inventore vero nobis. Nihil consequatur aperiam maxime molestias, qui doloremque ipsam quam autem architecto repellat, accusantium laudantium dignissimos assumenda nostrum, laboriosam optio voluptatibus illo iure itaque corporis sunt a?</p><p>Optio odit repudiandae vel culpa, neque, corrupti ipsam deserunt natus facere accusamus temporibus aspernatur veniam. Ipsam libero vero accusantium voluptatum quis repudiandae et placeat, similique eos? At ex facere error repudiandae similique, consequuntur accusantium repellat, a debitis laudantium, voluptatibus ea veniam incidunt asperiores laboriosam adipisci fugiat. Voluptatum rem fugit quaerat ratione voluptates laborum, reiciendis iure porro accusantium voluptate sapiente ut pariatur illo, placeat praesentium eos, blanditiis in quae dolorum quisquam magni excepturi? Nisi, delectus? Quasi error, unde laboriosam suscipit minus dolorem minima. Impedit numquam accusantium architecto sunt molestias vitae aliquam ea sed eaque ducimus quaerat a animi possimus sequi veniam aut maiores corrupti, ipsum dolorem! Impedit, possimus accusantium corporis quod maiores totam ipsam fuga dolore, sunt praesentium pariatur placeat saepe? Adipisci maiores animi, unde veniam eos fugit perferendis consequatur architecto reprehenderit. Ipsum laborum a sit, maxime quia deserunt itaque aliquid facere quis, praesentium atque doloremque architecto aut repellendus fugit neque dolore aliquam. Modi delectus impedit aut, ipsam esse laborum ipsa quisquam sunt ratione corrupti maiores ut ad? Totam sint quo numquam, similique distinctio eos iste ad voluptatum perferendis reprehenderit excepturi, veniam quae.</p><p>Dolores repellendus officiis minus, nesciunt doloribus delectus optio ipsum aliquid dolor neque mollitia quidem commodi consequuntur. Rerum impedit dolore at. Delectus molestias, possimus, incidunt velit impedit eius debitis aliquam quisquam molestiae ea natus voluptate voluptatum! Vel laudantium exercitationem aliquam. Hic, nam eos perspiciatis eum saepe nulla odit quis in libero sequi pariatur quidem quasi facere! Qui explicabo ratione nisi quam repellendus est iure nam minima. Voluptates odio blanditiis nisi mollitia tenetur libero eius, nesciunt eaque inventore deleniti. Corporis qui voluptate perferendis error possimus voluptates ipsam! Quis ad optio unde, ipsam voluptatibus accusantium numquam saepe minus tempore eveniet asperiores quaerat eaque, minima natus quae culpa pariatur delectus repellat perferendis distinctio aliquam! Obcaecati sed ea ipsam, eaque veritatis dolor aliquid sunt! Maxime ad cupiditate nam excepturi blanditiis! Possimus minima fugiat veritatis similique, aliquam recusandae modi magnam blanditiis voluptatibus natus corporis impedit dolores iure dolor repellat officia laudantium voluptatum temporibus rem. Dolore nesciunt vel illum dolor reiciendis incidunt recusandae amet magnam consectetur ducimus. Soluta vero in tenetur culpa provident mollitia, eos nemo beatae saepe unde maxime suscipit et incidunt architecto dignissimos aut velit modi voluptatibus, consequatur repellat dolor nulla ipsum autem illo? Suscipit adipisci, iste fugiat, fuga, deserunt laboriosam accusantium consectetur magnam maiores incidunt aperiam illum hic neque? Quos, mollitia in repellat, asperiores nisi consequatur saepe provident ipsam incidunt dolor repellendus, iure exercitationem reiciendis accusantium iste laudantium quam corrupti vero? Reiciendis, libero voluptatibus, quibusdam aliquid ipsam necessitatibus magni qui suscipit eaque quos esse, in natus expedita quam nulla aperiam repellat fuga et rem quae!</p>', 1, '2021-05-13 17:36:03'),
(21, 63, 18, 'Michael sólo estaba durmiendo', '1620920466_Godfather.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit atque consectetur voluptas facere incidunt magni eaque, nobis, illum dicta dolore perferendis repellat? Hic numquam officiis quis qui excepturi, laborum voluptate veniam aut impedit illum eius fugiat. Sit ullam libero iure eum, nisi, accusantium quis quisquam cum enim rem architecto, corrupti similique eligendi reprehenderit cumque esse commodi laborum possimus harum incidunt! Ullam voluptas maxime excepturi quos, ipsa libero tempore tenetur repellat. Eum veniam ea, sit saepe temporibus sed asperiores incidunt quidem perspiciatis omnis labore voluptates maxime modi nostrum unde. Harum totam aspernatur tenetur, ut cum voluptas? Adipisci, beatae ut dolore cum ab aliquam ad iure corporis dolorem cupiditate. Officiis nesciunt, aut quisquam modi odio aliquid dolorum quod provident eos consectetur dolorem necessitatibus voluptas assumenda pariatur itaque quis nulla commodi accusamus impedit quos sed aliquam error illo eveniet!&nbsp;</p><p>Unde mollitia totam deleniti cumque, incidunt minus nam tempore, neque placeat ea amet accusantium ipsum qui eaque cum sed perferendis dolorum suscipit, ullam aperiam. Aperiam sapiente obcaecati, optio accusamus corporis eaque. Perspiciatis aut itaque iure? Quis reprehenderit assumenda libero? Quidem eaque aspernatur fugit cupiditate facilis nulla id, aut aliquid. Quisquam quam velit hic debitis autem architecto sed quidem iure ex omnis neque beatae quos inventore aperiam possimus aut placeat accusamus cum saepe quasi at, ullam et. Cum similique cupiditate quidem fuga maxime quis iusto excepturi earum ratione veritatis, suscipit velit rem placeat perspiciatis nemo illo tempore explicabo in sapiente incidunt facere deleniti, inventore vero nobis. Nihil consequatur aperiam maxime molestias, qui doloremque ipsam quam autem architecto repellat, accusantium laudantium dignissimos assumenda nostrum, laboriosam optio voluptatibus illo iure itaque corporis sunt a?</p><p>Optio odit repudiandae vel culpa, neque, corrupti ipsam deserunt natus facere accusamus temporibus aspernatur veniam. Ipsam libero vero accusantium voluptatum quis repudiandae et placeat, similique eos? At ex facere error repudiandae similique, consequuntur accusantium repellat, a debitis laudantium, voluptatibus ea veniam incidunt asperiores laboriosam adipisci fugiat. Voluptatum rem fugit quaerat ratione voluptates laborum, reiciendis iure porro accusantium voluptate sapiente ut pariatur illo, placeat praesentium eos, blanditiis in quae dolorum quisquam magni excepturi? Nisi, delectus? Quasi error, unde laboriosam suscipit minus dolorem minima. Impedit numquam accusantium architecto sunt molestias vitae aliquam ea sed eaque ducimus quaerat a animi possimus sequi veniam aut maiores corrupti, ipsum dolorem! Impedit, possimus accusantium corporis quod maiores totam ipsam fuga dolore, sunt praesentium pariatur placeat saepe? Adipisci maiores animi, unde veniam eos fugit perferendis consequatur architecto reprehenderit. Ipsum laborum a sit, maxime quia deserunt itaque aliquid facere quis, praesentium atque doloremque architecto aut repellendus fugit neque dolore aliquam. Modi delectus impedit aut, ipsam esse laborum ipsa quisquam sunt ratione corrupti maiores ut ad? Totam sint quo numquam, similique distinctio eos iste ad voluptatum perferendis reprehenderit excepturi, veniam quae.</p><p>Dolores repellendus officiis minus, nesciunt doloribus delectus optio ipsum aliquid dolor neque mollitia quidem commodi consequuntur. Rerum impedit dolore at. Delectus molestias, possimus, incidunt velit impedit eius debitis aliquam quisquam molestiae ea natus voluptate voluptatum! Vel laudantium exercitationem aliquam. Hic, nam eos perspiciatis eum saepe nulla odit quis in libero sequi pariatur quidem quasi facere! Qui explicabo ratione nisi quam repellendus est iure nam minima. Voluptates odio blanditiis nisi mollitia tenetur libero eius, nesciunt eaque inventore deleniti. Corporis qui voluptate perferendis error possimus voluptates ipsam! Quis ad optio unde, ipsam voluptatibus accusantium numquam saepe minus tempore eveniet asperiores quaerat eaque, minima natus quae culpa pariatur delectus repellat perferendis distinctio aliquam! Obcaecati sed ea ipsam, eaque veritatis dolor aliquid sunt! Maxime ad cupiditate nam excepturi blanditiis! Possimus minima fugiat veritatis similique, aliquam recusandae modi magnam blanditiis voluptatibus natus corporis impedit dolores iure dolor repellat officia laudantium voluptatum temporibus rem. Dolore nesciunt vel illum dolor reiciendis incidunt recusandae amet magnam consectetur ducimus. Soluta vero in tenetur culpa provident mollitia, eos nemo beatae saepe unde maxime suscipit et incidunt architecto dignissimos aut velit modi voluptatibus, consequatur repellat dolor nulla ipsum autem illo? Suscipit adipisci, iste fugiat, fuga, deserunt laboriosam accusantium consectetur magnam maiores incidunt aperiam illum hic neque? Quos, mollitia in repellat, asperiores nisi consequatur saepe provident ipsam incidunt dolor repellendus, iure exercitationem reiciendis accusantium iste laudantium quam corrupti vero? Reiciendis, libero voluptatibus, quibusdam aliquid ipsam necessitatibus magni qui suscipit eaque quos esse, in natus expedita quam nulla aperiam repellat fuga et rem quae!</p>', 1, '2021-05-13 17:41:06'),
(22, 63, 19, 'El chico que intentó aprobar un módulo de programación', '1621204537_Mike Wazowski.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit atque consectetur voluptas facere incidunt magni eaque, nobis, illum dicta dolore perferendis repellat? Hic numquam officiis quis qui excepturi, laborum voluptate veniam aut impedit illum eius fugiat. Sit ullam libero iure eum, nisi, accusantium quis quisquam cum enim rem architecto, corrupti similique eligendi reprehenderit cumque esse commodi laborum possimus harum incidunt! Ullam voluptas maxime excepturi quos, ipsa libero tempore tenetur repellat. Eum veniam ea, sit saepe temporibus sed asperiores incidunt quidem perspiciatis omnis labore voluptates maxime modi nostrum unde. Harum totam aspernatur tenetur, ut cum voluptas? Adipisci, beatae ut dolore cum ab aliquam ad iure corporis dolorem cupiditate. Officiis nesciunt, aut quisquam modi odio aliquid dolorum quod provident eos consectetur dolorem necessitatibus voluptas assumenda pariatur itaque quis nulla commodi accusamus impedit quos sed aliquam error illo eveniet!&nbsp;</p><p>Unde mollitia totam deleniti cumque, incidunt minus nam tempore, neque placeat ea amet accusantium ipsum qui eaque cum sed perferendis dolorum suscipit, ullam aperiam. Aperiam sapiente obcaecati, optio accusamus corporis eaque. Perspiciatis aut itaque iure? Quis reprehenderit assumenda libero? Quidem eaque aspernatur fugit cupiditate facilis nulla id, aut aliquid. Quisquam quam velit hic debitis autem architecto sed quidem iure ex omnis neque beatae quos inventore aperiam possimus aut placeat accusamus cum saepe quasi at, ullam et. Cum similique cupiditate quidem fuga maxime quis iusto excepturi earum ratione veritatis, suscipit velit rem placeat perspiciatis nemo illo tempore explicabo in sapiente incidunt facere deleniti, inventore vero nobis. Nihil consequatur aperiam maxime molestias, qui doloremque ipsam quam autem architecto repellat, accusantium laudantium dignissimos assumenda nostrum, laboriosam optio voluptatibus illo iure itaque corporis sunt a?</p><p>Optio odit repudiandae vel culpa, neque, corrupti ipsam deserunt natus facere accusamus temporibus aspernatur veniam. Ipsam libero vero accusantium voluptatum quis repudiandae et placeat, similique eos? At ex facere error repudiandae similique, consequuntur accusantium repellat, a debitis laudantium, voluptatibus ea veniam incidunt asperiores laboriosam adipisci fugiat. Voluptatum rem fugit quaerat ratione voluptates laborum, reiciendis iure porro accusantium voluptate sapiente ut pariatur illo, placeat praesentium eos, blanditiis in quae dolorum quisquam magni excepturi? Nisi, delectus? Quasi error, unde laboriosam suscipit minus dolorem minima. Impedit numquam accusantium architecto sunt molestias vitae aliquam ea sed eaque ducimus quaerat a animi possimus sequi veniam aut maiores corrupti, ipsum dolorem! Impedit, possimus accusantium corporis quod maiores totam ipsam fuga dolore, sunt praesentium pariatur placeat saepe? Adipisci maiores animi, unde veniam eos fugit perferendis consequatur architecto reprehenderit. Ipsum laborum a sit, maxime quia deserunt itaque aliquid facere quis, praesentium atque doloremque architecto aut repellendus fugit neque dolore aliquam. Modi delectus impedit aut, ipsam esse laborum ipsa quisquam sunt ratione corrupti maiores ut ad? Totam sint quo numquam, similique distinctio eos iste ad voluptatum perferendis reprehenderit excepturi, veniam quae.</p><p>Dolores repellendus officiis minus, nesciunt doloribus delectus optio ipsum aliquid dolor neque mollitia quidem commodi consequuntur. Rerum impedit dolore at. Delectus molestias, possimus, incidunt velit impedit eius debitis aliquam quisquam molestiae ea natus voluptate voluptatum! Vel laudantium exercitationem aliquam. Hic, nam eos perspiciatis eum saepe nulla odit quis in libero sequi pariatur quidem quasi facere! Qui explicabo ratione nisi quam repellendus est iure nam minima. Voluptates odio blanditiis nisi mollitia tenetur libero eius, nesciunt eaque inventore deleniti. Corporis qui voluptate perferendis error possimus voluptates ipsam! Quis ad optio unde, ipsam voluptatibus accusantium numquam saepe minus tempore eveniet asperiores quaerat eaque, minima natus quae culpa pariatur delectus repellat perferendis distinctio aliquam! Obcaecati sed ea ipsam, eaque veritatis dolor aliquid sunt! Maxime ad cupiditate nam excepturi blanditiis! Possimus minima fugiat veritatis similique, aliquam recusandae modi magnam blanditiis voluptatibus natus corporis impedit dolores iure dolor repellat officia laudantium voluptatum temporibus rem. Dolore nesciunt vel illum dolor reiciendis incidunt recusandae amet magnam consectetur ducimus. Soluta vero in tenetur culpa provident mollitia, eos nemo beatae saepe unde maxime suscipit et incidunt architecto dignissimos aut velit modi voluptatibus, consequatur repellat dolor nulla ipsum autem illo? Suscipit adipisci, iste fugiat, fuga, deserunt laboriosam accusantium consectetur magnam maiores incidunt aperiam illum hic neque? Quos, mollitia in repellat, asperiores nisi consequatur saepe provident ipsam incidunt dolor repellendus, iure exercitationem reiciendis accusantium iste laudantium quam corrupti vero? Reiciendis, libero voluptatibus, quibusdam aliquid ipsam necessitatibus magni qui suscipit eaque quos esse, in natus expedita quam nulla aperiam repellat fuga et rem quae!</p>', 1, '2021-05-13 17:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(16, 'Toy Story', ''),
(18, 'Películas', ''),
(19, 'Desarrollo de Aplicaciones Web', ''),
(31, 'Off-topic', ''),
(32, 'hijoputa', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `admin` tinyint NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created_at`) VALUES
(63, 1, 'admin', 'admin', '$2y$10$/TKNDJsPfnBBL1186SxGu.5HwwbyPRu1CKIM0ELYgeqik1dE3BqYe', '2021-05-10 17:33:19'),
(101, 1, 'Juan Carlos', 'juckar@gmail.com', '$2y$10$8er.fMedWyAOrY6enlhSuu/smOVLSFOCxlOUpwlhIfO4PDZC2qEwa', '2021-05-13 17:06:47'),
(108, 1, 'Roman', 'roman@gmail.com', '$2y$10$ogm7PswVBt7mQjpq.UEJqOkfc1VKNhYn2T.zhJkvJAJLSocCRevjy', '2021-05-14 11:47:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
