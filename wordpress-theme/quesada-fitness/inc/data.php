<?php
/**
 * Fixed content of the site, taken from quesadafitness.com and translated to English.
 *
 * Each list can be changed from a child theme or plugin with the matching filter
 * (qf_facilities, qf_class_types, qf_team, qf_gallery_photos, qf_gallery_videos).
 * Editable everyday data (contact details, hours, prices, timetable) lives in the
 * Customizer instead: see inc/customizer.php.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Facilities and services ("Why choose our gym?").
 *
 * @return array<int, array{icon:string, title:string, text:string, photo:string}>
 */
function qf_facilities() {
	return apply_filters(
		'qf_facilities',
		array(
			array(
				'icon'  => 'dumbbell',
				'title' => __( 'Weights & machines', 'quesada-fitness' ),
				'text'  => __( 'A complete range of weights, our strength machines and cardio machines.', 'quesada-fitness' ),
				'photo' => '2024/11/IMG-20241031-WA0006.jpg',
			),
			array(
				'icon'  => 'target',
				'title' => __( 'Martial arts area', 'quesada-fitness' ),
				'text'  => __( 'A dedicated area to practise martial arts.', 'quesada-fitness' ),
				'photo' => '2024/12/upgradedgym6.jpg',
			),
			array(
				'icon'  => 'studio',
				'title' => __( 'Studios', 'quesada-fitness' ),
				'text'  => __( 'Several studios for our group classes.', 'quesada-fitness' ),
				'photo' => '2023/09/QFG7.jpg',
			),
			array(
				'icon'  => 'droplet',
				'title' => __( 'Changing rooms & showers', 'quesada-fitness' ),
				'text'  => __( 'Excellent changing room and shower facilities.', 'quesada-fitness' ),
				'photo' => '2023/09/IMG-20220916-WA00122.jpg',
			),
			array(
				'icon'  => 'cup',
				'title' => __( 'Relaxation room, canteen & shop', 'quesada-fitness' ),
				'text'  => __( 'A relaxation room, a canteen that opens after the morning classes, and a shop.', 'quesada-fitness' ),
				'photo' => '2023/09/QFG1.jpg',
			),
			array(
				'icon'  => 'hand',
				'title' => __( 'Osteopathy & chiromassage', 'quesada-fitness' ),
				'text'  => __( 'We also offer osteopathy and chiromassage.', 'quesada-fitness' ),
				'photo' => '2023/09/QFG17.jpg',
			),
		)
	);
}

/**
 * Class types with the descriptions from the Classes page.
 *
 * @return array<int, array{icon:string, title:string, text:string, meta:string}>
 */
function qf_class_types() {
	return apply_filters(
		'qf_class_types',
		array(
			array(
				'icon'  => 'target',
				'title' => __( 'Boxing & kickboxing', 'quesada-fitness' ),
				'text'  => __( 'Classes with Santiago López Silva, Spanish kickboxing champion. Are you ready to push your body to the limit?', 'quesada-fitness' ),
				'meta'  => __( 'Adults & juniors', 'quesada-fitness' ),
			),
			array(
				'icon'  => 'flame',
				'title' => __( 'Buttlift', 'quesada-fitness' ),
				'text'  => __( 'Cardio and resistance focused on the lower body: legs, glutes and abs.', 'quesada-fitness' ),
				'meta'  => __( '60 minutes', 'quesada-fitness' ),
			),
			array(
				'icon'  => 'target',
				'title' => __( 'Boxercises', 'quesada-fitness' ),
				'text'  => __( 'An hour of cardio fun based on non-contact boxing.', 'quesada-fitness' ),
				'meta'  => __( '1 hour', 'quesada-fitness' ),
			),
			array(
				'icon'  => 'music',
				'title' => __( 'Zumba', 'quesada-fitness' ),
				'text'  => __( 'Choreographed dance moves set to great music.', 'quesada-fitness' ),
				'meta'  => '',
			),
			array(
				'icon'  => 'users',
				'title' => __( 'Total Body Workout & Fit for All', 'quesada-fitness' ),
				'text'  => __( 'Classes designed for every level, using a variety of exercises and equipment.', 'quesada-fitness' ),
				'meta'  => __( 'All levels', 'quesada-fitness' ),
			),
			array(
				'icon'  => 'bike',
				'title' => __( 'Spinning', 'quesada-fitness' ),
				'text'  => __( 'Indoor cycling focused on endurance, strength, intervals, high intensity and recovery. Fantastic cardio with the music turned up!', 'quesada-fitness' ),
				'meta'  => '',
			),
			array(
				'icon'  => 'pulse',
				'title' => __( 'Pump', 'quesada-fitness' ),
				'text'  => __( 'Fast-paced but low-impact training using proven time under tension. Tone up, slim down and get fit by working every muscle group to music.', 'quesada-fitness' ),
				'meta'  => __( 'Low impact', 'quesada-fitness' ),
			),
			array(
				'icon'  => 'heart',
				'title' => __( 'Pilates', 'quesada-fitness' ),
				'text'  => __( 'Low-impact, controlled movements that improve balance, core strength, posture and alignment, with breathing and movement techniques.', 'quesada-fitness' ),
				'meta'  => __( 'Low impact', 'quesada-fitness' ),
			),
		)
	);
}

/**
 * Team members from the Team page. Photos are in the media library.
 *
 * @return array<int, array{name:string, role:string, bio:string, photo:string}>
 */
function qf_team() {
	return apply_filters(
		'qf_team',
		array(
			array(
				'name'  => 'Santiago',
				'role'  => __( 'Manager · Kickboxing coach', 'quesada-fitness' ),
				'bio'   => __( 'I\'m the manager of Quesada Fitness GYM and the current Spanish heavyweight kickboxing champion. In 2014 I became world champion with the F.E.A.M.Y.D.A., one of the best kickboxers of that time. Today I coach kickboxing for children and adults, and I\'m a gym instructor and personal trainer with 10 years of experience.', 'quesada-fitness' ),
				'photo' => '2021/11/Santi-min-1024x683.png',
			),
			array(
				'name'  => 'Jodi',
				'role'  => __( 'Gym instructor · Personal trainer', 'quesada-fitness' ),
				'bio'   => __( 'I came to Spain in 2014 and carried on with my weight-loss journey. I took up many interests, including boxing, and in a short time I lost a lot of weight. During that period I set out to qualify as a gym instructor and personal trainer. Guided training and corrective exercise are two things I like to include in my classes and personal training sessions.', 'quesada-fitness' ),
				'photo' => '2021/11/Jodii.png',
			),
			array(
				'name'  => 'Gergana',
				'role'  => __( 'Personal trainer · Gym instructor', 'quesada-fitness' ),
				'bio'   => __( 'I\'m a very energetic person. I joined the gym in 2015, at a time in my life when I was emotionally broken. Through regular daily training I started to feel happy and motivated again. My interest grew as I gained experience, and I\'m now a qualified personal trainer and gym instructor. My goal is to help our members reach their fitness goals.', 'quesada-fitness' ),
				'photo' => '2021/11/Gergana-min-1024x683.png',
			),
			array(
				'name'  => 'Luiz',
				'role'  => __( 'Personal trainer · Fitness instructor', 'quesada-fitness' ),
				'bio'   => __( 'My name is Luiz and I\'m a qualified personal trainer and fitness instructor. I\'ve been training in gyms for the last 20 years, and in 2012 I decided to turn my hobby into my profession. I qualified in Ireland and worked in gyms in Dublin until I moved to Spain. Now I\'m looking forward to sharing my passion and inspiring others at Quesada Fitness GYM.', 'quesada-fitness' ),
				'photo' => '2021/11/Luiz-min-1024x683.png',
			),
			array(
				'name'  => 'Sara',
				'role'  => __( 'Fitness instructor · Personal trainer', 'quesada-fitness' ),
				'bio'   => __( 'I started at the gym in 2012 and worked very hard to reach my personal goals. After working as a fitness instructor in the UK, I renewed my qualifications in Spain and added a personal trainer qualification. Since then I\'ve taught Zumba and Bodyshox classes, among others. My goal is to motivate you to fight for your goals and reach your full potential.', 'quesada-fitness' ),
				'photo' => '2021/11/Saraa.png',
			),
			array(
				'name'  => 'Ela',
				'role'  => __( 'Zumba instructor', 'quesada-fitness' ),
				'bio'   => __( 'My name is Ela, and I am an instructor at Quesada Fitness Gym. My fitness journey started in Ireland many years ago, eventually leading me to Zumba, which I instantly fell in love with as it allowed me to combine my passion for dance with my interest in fitness. Shortly after moving to Spain in 2017, I obtained my licenses in Zumba Fitness, Zumba Gold, and Zumba Toning.', 'quesada-fitness' ),
				'photo' => '2026/02/Stela-QFG-removebg-preview.webp',
			),
		)
	);
}

/**
 * Photos of the gym shown on the home page and in the gallery.
 *
 * @return array<int, array{path:string, alt:string}>
 */
function qf_gallery_photos() {
	return apply_filters(
		'qf_gallery_photos',
		array(
			array( 'path' => '2024/11/IMG-20241031-WA0007.jpg', 'alt' => __( 'Strength machines on the gym floor', 'quesada-fitness' ) ),
			array( 'path' => '2024/12/upgradedgym7.jpg', 'alt' => __( 'Martial arts area with mats', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG7.jpg', 'alt' => __( 'Spinning studio', 'quesada-fitness' ) ),
			array( 'path' => '2024/12/upgradedgym1.jpg', 'alt' => __( 'Gym floor seen from above', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/Gym-entrance-2.jpg', 'alt' => __( 'Gym entrance', 'quesada-fitness' ) ),
			array( 'path' => '2024/11/IMG-20241031-WA0005.jpg', 'alt' => __( 'Plate-loaded strength machine', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG2.jpg', 'alt' => __( 'Studio with wooden floor', 'quesada-fitness' ) ),
			array( 'path' => '2024/11/IMG-20241031-WA0004.jpg', 'alt' => __( 'Cable machines and mirrors', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG16.jpg', 'alt' => __( 'Group class in a studio', 'quesada-fitness' ) ),
			array( 'path' => '2024/12/upgradedgym2.jpg', 'alt' => __( 'Weights area', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG9.jpg', 'alt' => __( 'Machines and TV screens', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG13.jpg', 'alt' => __( 'Gym floor', 'quesada-fitness' ) ),
			array( 'path' => '2024/11/newshowers.jpg', 'alt' => __( 'New showers', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/IMG-20220916-WA00083.jpg', 'alt' => __( 'Changing room with lockers', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG1.jpg', 'alt' => __( 'Relaxation room', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG10.jpg', 'alt' => __( 'Drinks and snacks at the canteen', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG15.jpg', 'alt' => __( 'Canteen seating area', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/IMG-20220902-WA000612.jpg', 'alt' => __( 'Outdoor terrace', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG17.jpg', 'alt' => __( 'Treatment room', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/Stairs-rotated.jpg', 'alt' => __( 'Stairs between floors', 'quesada-fitness' ) ),
			array( 'path' => '2023/09/QFG81.jpg', 'alt' => __( 'Front of the building', 'quesada-fitness' ) ),
			array( 'path' => '2024/12/upgradedgym6.jpg', 'alt' => __( 'Martial arts mats', 'quesada-fitness' ) ),
		)
	);
}

/**
 * Videos on the Gallery page.
 *
 * @return string[] Paths relative to wp-content/uploads.
 */
function qf_gallery_videos() {
	return apply_filters(
		'qf_gallery_videos',
		array(
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_220ed559.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_34f1b851.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_a66853bb.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_b3f936c5.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.25_d8898797.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.01.26_308e85fb.mp4',
			'2025/09/Video-de-WhatsApp-2025-08-08-a-las-13.03.49_f4d0301f.mp4',
		)
	);
}

/**
 * Words in the red marquee band.
 *
 * @return string[]
 */
function qf_marquee_items() {
	return array(
		__( 'Boxing', 'quesada-fitness' ),
		__( 'Kickboxing', 'quesada-fitness' ),
		__( 'Spinning', 'quesada-fitness' ),
		__( 'Zumba', 'quesada-fitness' ),
		__( 'Pilates', 'quesada-fitness' ),
		__( 'TRX', 'quesada-fitness' ),
		__( 'Pump FX', 'quesada-fitness' ),
		__( 'Tabata', 'quesada-fitness' ),
		__( 'Personal training', 'quesada-fitness' ),
	);
}
