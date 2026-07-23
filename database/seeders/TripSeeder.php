<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\TripStop;
use App\Models\User;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $damascus = User::where('email', 'damascus@office.com')->first();
        $aleppo = User::where('email', 'aleppo@office.com')->first();
        $homs = User::where('email', 'homs@office.com')->first();
        $testOffice = User::where('email', 'testoffice@test.com')->first();

        $trips = [
            [
                'place_name' => 'Old Damascus City Tour',
                'place_name_ar' => 'جولة في دمشق القديمة',
                'place_name_en' => 'Old Damascus City Tour',
                'seat_price' => 35.00,
                'duration' => '1 day',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 20,
                'departure_time' => now()->addDays(5),
                'meeting_point' => 'Umayyad Square',
                'meeting_point_ar' => 'ساحة الأمويين',
                'meeting_point_en' => 'Umayyad Square',
                'description' => 'Discover Damascus, the oldest capital in the world, on a full-day tour of the UNESCO-listed Old City. Visit the magnificent Umayyad Mosque, wander through the legendary Al-Hamidiyah Souq, explore the historic Straight Street, and see the ancient Church of Ananias hidden beneath the old city. Enjoy a traditional Syrian lunch and captivating stories from our expert guide.
Includes: professional guide, traditional Syrian lunch, hotel pickup & drop-off, electronic entry ticket.',
                'description_ar' => 'اكتشف دمشق، أقدم عاصمة في العالم، في جولة يوم كامل في المدينة القديمة المدرجة ضمن التراث العالمي. زر الجامع الأموي المهيب، تجول في سوق الحميدية الأسطوري، واستكشف الشارع التاريخي المستقيم وكنيسة حنانيا القديمة المخبأة تحت المدينة. استمتع بغداء سوري تقليدي وقصص آسرة من مرشدنا الخبير.
يشمل: مرشد محترف، غداء سوري تقليدي، توصيل من الفندق، تذكرة إلكترونية للدخول.',
                'description_en' => 'Discover Damascus, the oldest capital in the world, on a full-day tour of the UNESCO-listed Old City. Visit the magnificent Umayyad Mosque, wander through the legendary Al-Hamidiyah Souq, explore the historic Straight Street, and see the ancient Church of Ananias. Enjoy a traditional Syrian lunch and captivating stories from our expert guide.
Includes: professional guide, traditional Syrian lunch, hotel pickup & drop-off, electronic entry ticket.',
                'latitude' => 33.5130,
                'longitude' => 36.3070,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $damascus->id,
            ],
            [
                'place_name' => 'Mount Qasioun Panoramic Bus Tour',
                'place_name_ar' => 'جولة باص بانورامية على جبل قاسيون',
                'place_name_en' => 'Mount Qasioun Panoramic Bus Tour',
                'seat_price' => 25.00,
                'duration' => '4 hours',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 25,
                'departure_time' => now()->addDays(10),
                'meeting_point' => 'Jaramana Bus Station',
                'meeting_point_ar' => 'محطة جرمانا',
                'meeting_point_en' => 'Jaramana Bus Station',
                'description' => 'Enjoy a scenic bus ride to the summit of Mount Qasioun (1,200m), offering breathtaking panoramic views of Damascus and the Ghouta green belt. Once at the top, explore panoramic viewpoints, visit historic shrines, and enjoy refreshments at a mountain cafe with traditional Syrian tea and coffee.
Includes: professional guide, round-trip transport, traditional tea & coffee, electronic entry ticket.',
                'description_ar' => 'استمتع برحلة باص سياحية إلى قمة جبل قاسيون (1,200م) مع إطلالات بانورامية خلابة على دمشق وغوطة دمشق الخضراء. في القمة، تمتع بمشاهدة المعالم التاريخية والمناظر الخلابة وجلسة في مقهى جبلي مع الشاي والقهوة السورية التقليدية.
يشمل: مرشد محترف، نقل ذهاب وإياب، شاي وقهوة تقليدية، تذكرة إلكترونية للدخول.',
                'description_en' => 'Enjoy a scenic bus ride to the summit of Mount Qasioun (1,200m), offering breathtaking panoramic views of Damascus and the Ghouta green belt. Once at the top, explore panoramic viewpoints, visit historic shrines, and enjoy refreshments at a mountain cafe with traditional Syrian tea and coffee.
Includes: professional guide, round-trip transport, traditional tea & coffee, electronic entry ticket.',
                'latitude' => 33.4870,
                'longitude' => 36.3480,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $damascus->id,
            ],
            [
                'place_name' => 'Aleppo Souq Shopping',
                'place_name_ar' => 'تسوق في سوق حلب',
                'place_name_en' => 'Aleppo Souq Shopping',
                'seat_price' => 35.00,
                'duration' => '1 day',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 25,
                'departure_time' => now()->addDays(3),
                'meeting_point' => 'Central Bus Station',
                'meeting_point_ar' => 'محطة الباص المركزية',
                'meeting_point_en' => 'Central Bus Station',
                'description' => 'Explore the largest covered historical market in the Middle East, stretching over 13 kilometers within Aleppo\'s UNESCO-listed Old City. Start at the iconic Citadel of Aleppo, then wander through fragrant spice and textile markets. Meet master artisans and enjoy authentic Aleppian cuisine including cherry kebab and pistachio baklava.
Includes: professional guide, traditional Aleppian lunch, hotel pickup, electronic entry ticket.',
                'description_ar' => 'استكشف أكبر سوق تاريخي مسقوف في الشرق الأوسط، ويمتد لأكثر من 13 كيلومتراً داخل مدينة حلب القديمة المدرجة ضمن التراث العالمي. ابدأ من قلعة حلب الشهيرة، ثم تجول في أسواق العطارين العطرة وأسواق المنسوجات. قابل الحرفيين المهرة واستمتع بالمأكولات الحلبية الأصيلة.
يشمل: مرشد محترف، غداء حلبي تقليدي، توصيل من الفندق، تذكرة إلكترونية للدخول.',
                'description_en' => 'Explore the largest covered historical market in the Middle East, stretching over 13 kilometers within Aleppo\'s UNESCO-listed Old City. Start at the iconic Citadel of Aleppo, then wander through fragrant spice and textile markets. Meet master artisans and enjoy authentic Aleppian cuisine.
Includes: professional guide, traditional Aleppian lunch, hotel pickup, electronic entry ticket.',
                'latitude' => 36.2020,
                'longitude' => 37.1510,
                'status' => 'open',
                'trip_type' => 'shopping',
                'user_id' => $aleppo->id,
            ],
            [
                'place_name' => 'Krak des Chevaliers Castle',
                'place_name_ar' => 'قلعة الحصن',
                'place_name_en' => 'Krak des Chevaliers Castle',
                'seat_price' => 45.00,
                'duration' => '1 day',
                'food_policy' => 'Not Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 18,
                'departure_time' => now()->addDays(7),
                'meeting_point' => 'Homs Central Square',
                'meeting_point_ar' => 'ساحة حمص المركزية',
                'meeting_point_en' => 'Homs Central Square',
                'description' => 'Visit the finest medieval Crusader castle in the world, a UNESCO Site perched on a 650-meter hill. Built by the Knights Hospitaller (1142-1271), Krak des Chevaliers features double-ring walls, a 36-meter moat, round towers, and a Gothic great hall. Learn about Sultan Baybars\' legendary siege and enjoy panoramic views.
Includes: professional guide, round-trip transport, electronic entry ticket.',
                'description_ar' => 'زر أروع قلعة صليبية من العصور الوسطى في العالم، إحدى مواقع اليونسكو على تل بارتفاع 650 متراً. بناها فرسان الإسبتارية (1142-1271)، وتتميز بجدارين مزدوجين وخندق بعرض 36 متراً وأبراج مستديرة وقاعة قوطية. تعرف على حصار السلطان بيبرس الأسطوري واستمتع بإطلالات بانورامية.
يشمل: مرشد محترف، نقل ذهاب وإياب، تذكرة إلكترونية للدخول.',
                'description_en' => 'Visit the finest medieval Crusader castle in the world, a UNESCO Site perched on a 650-meter hill. Built by the Knights Hospitaller (1142-1271), Krak des Chevaliers features double-ring walls, a 36-meter moat, round towers, and a Gothic great hall. Learn about Sultan Baybars\' legendary siege and enjoy panoramic views.
Includes: professional guide, round-trip transport, electronic entry ticket.',
                'latitude' => 34.7350,
                'longitude' => 36.7170,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $homs->id,
            ],
            [
                'place_name' => 'Bosra Ancient City',
                'place_name_ar' => 'مدينة بوصرى القديمة',
                'place_name_en' => 'Bosra Ancient City',
                'seat_price' => 40.00,
                'duration' => '1 day',
                'food_policy' => 'Not Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 20,
                'departure_time' => now()->subDays(5),
                'meeting_point' => 'Sahr al-Jannah',
                'meeting_point_ar' => 'صحراء الجنة',
                'meeting_point_en' => 'Sahr al-Jannah',
                'description' => 'Journey back in time to the magnificent Roman city of Bosra, a UNESCO Site 120 kilometers south of Damascus. Marvel at the spectacular 2nd-century Roman theatre (seating 15,000), the colonnaded street, Nabatean gate, and the Cathedral of Bosra built in 512 AD. Discover 2,000 years of history in dramatic black basalt stone.
Includes: professional guide, round-trip transport from Damascus, electronic entry ticket.',
                'description_ar' => 'سافر عبر الزمن إلى مدينة بوصرى الرومانية الرائعة، إحدى مواقع اليونسكو على بعد 120 كيلومتراً جنوب دمشق. تمتع بمشاهدة المسرح الروماني المذهل من القرن الثاني (يتسع لـ15,000)، والشارع المعمد بالأعمدة، وبوابة الأنباط، وكاتدرائية بوصرى. اكتشف 2,000 عام من التاريخ بالحجر البازلتي الأسود.
يشمل: مرشد محترف، نقل ذهاب وإياب من دمشق، تذكرة إلكترونية للدخول.',
                'description_en' => 'Journey back in time to the magnificent Roman city of Bosra, a UNESCO Site 120 kilometers south of Damascus. Marvel at the spectacular 2nd-century Roman theatre (seating 15,000), the colonnaded street, Nabatean gate, and the Cathedral of Bosra. Discover 2,000 years of history in dramatic black basalt stone.
Includes: professional guide, round-trip transport from Damascus, electronic entry ticket.',
                'latitude' => 32.5200,
                'longitude' => 36.4820,
                'status' => 'finished',
                'trip_type' => 'cultural',
                'user_id' => $damascus->id,
            ],
            [
                'place_name' => 'Damascus Old City Multi-Stop Tour',
                'place_name_ar' => 'جولة في دمشق القديمة متعددة المحطات',
                'place_name_en' => 'Damascus Old City Multi-Stop Tour',
                'seat_price' => 20.00,
                'duration' => '3 hours',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 25,
                'departure_time' => now()->addDays(2),
                'meeting_point' => 'Bab Sharqi Arch',
                'meeting_point_ar' => 'قوس باب شرقي',
                'meeting_point_en' => 'Bab Sharqi Arch',
                'description' => 'A 3-hour guided walking tour through three iconic Old Damascus locations. Begin at Bab Touma, visit the Chapel of St. Paul, explore Maktab Anbar palace museum, and end at Al-Hamidiyah Souq with famous Bakdash ice cream. Perfect for experiencing the essence of Damascus.
Includes: professional local guide, electronic entry tickets.',
                'description_ar' => 'جولة مشي مدتها 3 ساعات مع مرشد في ثلاثة معالم أيقونية في دمشق القديمة. ابدأ من باب توما، زر كنيسة القديس بولس، واستكشف قصر مكتب عنبر، واختتم في سوق الحميدية مع بوظة بكداش الشهيرة. مثالية لتجربة جوهر دمشق.
يشمل: مرشد محلي محترف، تذاكر إلكترونية للدخول.',
                'description_en' => 'A 3-hour guided walking tour through three iconic Old Damascus locations. Begin at Bab Touma, visit the Chapel of St. Paul, explore Maktab Anbar palace museum, and end at Al-Hamidiyah Souq with famous Bakdash ice cream. Perfect for experiencing the essence of Damascus.
Includes: professional local guide, electronic entry tickets.',
                'latitude' => 33.5137,
                'longitude' => 36.3152,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $damascus->id,
            ],
        ];

        $newTrips = [
            [
                'place_name' => 'Al-Nawfara Cafe Experience',
                'place_name_ar' => 'مقهى النوفرة - تجربة الحكواتي الدمشقي',
                'place_name_en' => 'Al-Nawfara Cafe - The Damascene Storyteller Experience',
                'seat_price' => 18.00,
                'duration' => '3 hours',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 20,
                'departure_time' => now()->addDays(9),
                'meeting_point' => 'Umayyad Mosque - Eastern Gate (Bab Al-Qaymariya)',
                'meeting_point_ar' => 'الجامع الأموي - الباب الشرقي (باب القيمرية)',
                'meeting_point_en' => 'Umayyad Mosque - Eastern Gate (Bab Al-Qaymariya)',
                'description' => 'Visit the oldest cafe in Damascus (250+ years), behind the Umayyad Mosque\'s eastern gate. Enjoy tea, coffee, and shisha while listening to the Hakawati storyteller perform epic tales at 8 PM. The basalt courtyard and straw chairs create an unforgettable atmosphere.
Includes: traditional tea & coffee, Hakawati storytelling show, local guide, electronic entry ticket.',
                'description_ar' => 'زر أقدم مقهى في دمشق (أكثر من 250 عاماً)، خلف الباب الشرقي للجامع الأموي. استمتع بالشاي والقهوة والنرجيلة مع الحكواتي الذي يروي الحكايات الملحمية عند الساعة 8. فناء البازلت وكراسي القش تخلق جواً لا يُنسى.
يشمل: شاي وقهوة تقليدية، عرض الحكواتي، مرشد محلي، تذكرة إلكترونية للدخول.',
                'description_en' => 'Visit the oldest cafe in Damascus (250+ years), behind the Umayyad Mosque\'s eastern gate. Enjoy tea, coffee, and shisha while listening to the Hakawati storyteller perform epic tales at 8 PM. The basalt courtyard and straw chairs create an unforgettable atmosphere.
Includes: traditional tea & coffee, Hakawati storytelling show, local guide, electronic entry ticket.',
                'latitude' => 33.5115,
                'longitude' => 36.3065,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $homs->id,
            ],
            [
                'place_name' => 'Midhat Pasha Souq Tour',
                'place_name_ar' => 'جولة في سوق مدحت باشا',
                'place_name_en' => 'Midhat Pasha Souq Tour',
                'seat_price' => 12.00,
                'duration' => '2 hours',
                'food_policy' => 'Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 25,
                'departure_time' => now()->addDays(11),
                'meeting_point' => 'Bab Al-Jabiya - Old Damascus',
                'meeting_point_ar' => 'باب الجابية - دمشق القديمة',
                'meeting_point_en' => 'Bab Al-Jabiya - Old Damascus',
                'description' => 'Walk through the oldest continuously inhabited street in the world, built in 64 BC as Via Recta. This 600m covered market combines Roman arches, Ayyubid gates, and an Ottoman iron roof. Discover Damascene silk, copperware, spices, and perfumes.
Includes: professional guide, electronic entry ticket.',
                'description_ar' => 'تجول في أقدم شارع مأهول باستمرار في العالم، بني عام 64 ق.م. باسم الشارع المستقيم. يمتد هذا السوق المسقوف 600 متر ويجمع الأقواس الرومانية والأبواب الأيوبية والسقف العثماني الحديدي. اكتشف الحرير الدمشقي والنحاس والبهارات والعطور.
يشمل: مرشد محترف، تذكرة إلكترونية للدخول.',
                'description_en' => 'Walk through the oldest continuously inhabited street in the world, built in 64 BC as Via Recta. This 600m covered market combines Roman arches, Ayyubid gates, and an Ottoman iron roof. Discover Damascene silk, copperware, spices, and perfumes.
Includes: professional guide, electronic entry ticket.',
                'latitude' => 33.5075,
                'longitude' => 36.3010,
                'status' => 'open',
                'trip_type' => 'shopping',
                'user_id' => $testOffice->id,
            ],
            [
                'place_name' => 'Damascus Citadel Tour',
                'place_name_ar' => 'جولة في قلعة دمشق',
                'place_name_en' => 'Damascus Citadel Tour',
                'seat_price' => 12.00,
                'duration' => '2 hours',
                'food_policy' => 'Not Allowed',
                'area_serviced' => 'Serviced',
                'available_seats' => 30,
                'departure_time' => now()->addDays(13),
                'meeting_point' => 'Damascus Citadel - Main Entrance',
                'meeting_point_ar' => 'قلعة دمشق - المدخل الرئيسي',
                'meeting_point_en' => 'Damascus Citadel - Main Entrance',
                'description' => 'Explore one of the largest medieval Islamic fortresses (230m x 150m), a UNESCO Site since 1979. Built by Al-Adil (Saladin\'s brother) with 12 towers, a 20m moat, and the first stone muqarnas in Damascus. Witness to Crusader sieges, Mongol invasions, and Mamluk and Ottoman rule with panoramic city views.
Includes: professional guide, electronic entry ticket.',
                'description_ar' => 'استكشف واحدة من أضخم القلاع الإسلامية (230م × 150م)، ضمن مواقع اليونسكو منذ 1979. بناها الملك العادل شقيق صلاح الدين بـ 12 برجاً وخندق بعرض 20م وأول مقرنص حجري في دمشق. شهدت حصارات صليبية وغزوات مغولية وحكماً مملوكياً وعثمانياً مع إطلالات بانورامية.
يشمل: مرشد محترف، تذكرة إلكترونية للدخول.',
                'description_en' => 'Explore one of the largest medieval Islamic fortresses (230m x 150m), a UNESCO Site since 1979. Built by Al-Adil (Saladin\'s brother) with 12 towers, a 20m moat, and the first stone muqarnas in Damascus. Witness to Crusader sieges, Mongol invasions, and Mamluk and Ottoman rule with panoramic city views.
Includes: professional guide, electronic entry ticket.',
                'latitude' => 33.5123,
                'longitude' => 36.3020,
                'status' => 'open',
                'trip_type' => 'cultural',
                'user_id' => $testOffice->id,
            ],
        ];

        $trips = array_merge($trips, $newTrips);

        foreach ($trips as $tripData) {
            $trip = Trip::create($tripData);

            if ($tripData['place_name'] === 'Damascus Old City Multi-Stop Tour') {
                $stops = [
                    [
                        'place_name' => 'Bab Touma',
                        'place_name_ar' => 'باب توما',
                        'place_name_en' => 'Bab Touma',
                        'description' => 'One of the seven ancient gates of Damascus, marking the entrance to the vibrant Christian Quarter with its churches, traditional houses, and hidden cafes.',
                        'description_ar' => 'أحد أبواب دمشق السبعة القديمة، مدخل الحي المسيحي النابض بالحياة بكنائسه وبيوته التقليدية ومقاهيه المخفية.',
                        'description_en' => 'One of the seven ancient gates of Damascus, entrance to the vibrant Christian Quarter with churches, traditional houses, and hidden cafes.',
                        'stop_duration' => 0.5,
                        'stop_order' => 1,
                        'latitude' => 33.5140,
                        'longitude' => 36.3150,
                    ],
                    [
                        'place_name' => 'Maktab Anbar',
                        'place_name_ar' => 'مكتب عنبر',
                        'place_name_en' => 'Maktab Anbar',
                        'description' => 'A stunning 19th-century Damascene palace turned museum, showcasing intricate woodwork, colorful marble mosaics, painted gold-leaf ceilings, and a serene central courtyard.',
                        'description_ar' => 'قصر دمشقي رائع من القرن التاسع عشر تحول إلى متحف، يعرض أعمالاً خشبية معقدة وفسيفساء رخامية ملونة وأسقفاً مذهبة وفناءً مركزياً هادئاً.',
                        'description_en' => 'A stunning 19th-century Damascene palace turned museum, showcasing intricate woodwork, colorful marble mosaics, painted gold-leaf ceilings, and a serene courtyard.',
                        'stop_duration' => 0.5,
                        'stop_order' => 2,
                        'latitude' => 33.5099,
                        'longitude' => 36.3095,
                    ],
                    [
                        'place_name' => 'Al-Hamidiyah Souq',
                        'place_name_ar' => 'سوق الحميدية',
                        'place_name_en' => 'Al-Hamidiyah Souq',
                        'description' => 'The largest and most famous souq in Damascus, covered with an iconic arched iron roof built in 1880. A bustling market since the 14th century with spices, textiles, sweets, and artisan workshops.',
                        'description_ar' => 'أكبر وأشهر أسواق دمشق، مسقوف بسقف حديدي مقوس شهير بني عام 1880. سوق نابض بالحياة منذ القرن الرابع عشر بالبهارات والمنسوجات والحلويات وورش الحرفيين.',
                        'description_en' => 'Damascus\' largest souq with an iconic arched iron roof built in 1880. Bustling since the 14th century with spices, textiles, sweets, and artisan workshops.',
                        'stop_duration' => 0.5,
                        'stop_order' => 3,
                        'latitude' => 33.5115,
                        'longitude' => 36.3052,
                    ],
                ];

                foreach ($stops as $stopData) {
                    $trip->stops()->create($stopData);
                }
            }

            if ($tripData['place_name'] === 'Al-Nawfara Cafe Experience') {
                $stops = [
                    [
                        'place_name' => 'Umayyad Mosque - Eastern Gate',
                        'place_name_ar' => 'الجامع الأموي - الباب الشرقي',
                        'place_name_en' => 'Umayyad Mosque - Eastern Gate',
                        'description' => 'A magnificent gate leading to the courtyard of the Great Umayyad Mosque, one of the oldest and largest mosques in the world. The surrounding Al-Qaymariya neighborhood features traditional Damascene architecture.',
                        'description_ar' => 'بوابة رائعة تؤدي إلى صحن الجامع الأموي الكبير، أحد أقدم وأكبر المساجد في العالم. يتميز حي القيمرية المحيط بالعمارة الدمشقية التقليدية.',
                        'description_en' => 'Magnificent gate to the Great Umayyad Mosque courtyard. The surrounding Al-Qaymariya neighborhood features traditional Damascene architecture.',
                        'stop_duration' => 0.5,
                        'stop_order' => 1,
                        'latitude' => 33.5115,
                        'longitude' => 36.3065,
                    ],
                    [
                        'place_name' => 'Al-Nawfara Cafe & Hakawati',
                        'place_name_ar' => 'مقهى النوفرة والحكواتي',
                        'place_name_en' => 'Al-Nawfara Cafe & Hakawati',
                        'description' => 'The oldest cafe in Damascus (250+ years), originally a bathhouse. Famous for the Hakawati storyteller who performs epic tales of Arab heritage every evening at 8 PM wearing traditional attire.',
                        'description_ar' => 'أقدم مقهى في دمشق (أكثر من 250 عاماً)، كان في الأصل حماماً. يشتهر بالحكواتي الذي يروي الحكايات الملحمية من التراث العربي كل مساء عند الساعة 8 مرتدياً الزي التقليدي.',
                        'description_en' => 'The oldest cafe in Damascus (250+ years), originally a bathhouse. Famous for the Hakawati storyteller performing epic Arab heritage tales at 8 PM.',
                        'stop_duration' => 2.0,
                        'stop_order' => 2,
                        'latitude' => 33.5110,
                        'longitude' => 36.3060,
                    ],
                    [
                        'place_name' => 'Old Damascus Alleys Walk',
                        'place_name_ar' => 'جولة في أزقة دمشق القديمة',
                        'place_name_en' => 'Old Damascus Alleys Walk',
                        'description' => 'A peaceful stroll through the narrow historic alleyways of old Damascus, passing traditional houses, small artisan workshops, and local bakeries with authentic Damascene architecture.',
                        'description_ar' => 'نزهة هادئة في الأزقة التاريخية الضيقة لدمشق القديمة، مروراً بالمنازل التقليدية وورش الحرفيين الصغيرة والمخابز المحلية بهندسة دمشقية أصيلة.',
                        'description_en' => 'A peaceful stroll through narrow historic alleyways of old Damascus, passing traditional houses, artisan workshops, and local bakeries.',
                        'stop_duration' => 0.5,
                        'stop_order' => 3,
                        'latitude' => 33.5105,
                        'longitude' => 36.3070,
                    ],
                ];

                foreach ($stops as $stopData) {
                    $trip->stops()->create($stopData);
                }
            }

            if ($tripData['place_name'] === 'Midhat Pasha Souq Tour') {
                $stops = [
                    [
                        'place_name' => 'Bab al-Jabiya - Souq Entrance',
                        'place_name_ar' => 'باب الجابية - مدخل السوق',
                        'place_name_en' => 'Bab al-Jabiya - Souq Entrance',
                        'description' => 'One of the seven historic gates of Damascus, marking the western entrance to Midhat Pasha Souq. Named after the spring of Jabiya in the Golan Heights.',
                        'description_ar' => 'أحد أبواب دمشق السبعة التاريخية، المدخل الغربي لسوق مدحت باشا. سمي نسبةً إلى عين جابية في الجولان.',
                        'description_en' => 'One of the seven historic gates of Damascus, marking the western entrance to Midhat Pasha Souq.',
                        'stop_duration' => 0.25,
                        'stop_order' => 1,
                        'latitude' => 33.5075,
                        'longitude' => 36.3010,
                    ],
                    [
                        'place_name' => 'Midhat Pasha Covered Market',
                        'place_name_ar' => 'سوق مدحت باشا المسقوف',
                        'place_name_en' => 'Midhat Pasha Covered Market',
                        'description' => 'The heart of the souq with traditional Damascene textiles, handcrafted copperware, aromatic spices and perfumes. The iron roof with glass openings creates a beautiful play of light and shadow.',
                        'description_ar' => 'قلب السوق حيث المنسوجات الدمشقية التقليدية والنحاس المشغول يدوياً والبهارات العطرية والعطور. يخلق السقف الحديدي ذو الفتحات الزجاجية لعبة جميلة من الضوء والظل.',
                        'description_en' => 'The heart of the souq with Damascene textiles, copperware, spices and perfumes. The iron roof with glass openings creates a beautiful play of light and shadow.',
                        'stop_duration' => 1.25,
                        'stop_order' => 2,
                        'latitude' => 33.5085,
                        'longitude' => 36.3035,
                    ],
                    [
                        'place_name' => 'Souq Exit - Umayyad Mosque Area',
                        'place_name_ar' => 'مخرج السوق - منطقة الجامع الأموي',
                        'place_name_en' => 'Souq Exit - Umayyad Mosque Area',
                        'description' => 'The eastern end of the souq opens to the vibrant area surrounding the Great Umayyad Mosque. A perfect spot to rest and admire one of Islam\'s greatest architectural masterpieces.',
                        'description_ar' => 'الطرف الشرقي من السوق يفتح على المنطقة النابضة المحيطة بالجامع الأموي الكبير. مكان مثالي للراحة والاستمتاع بأحد أعظم التحف المعمارية الإسلامية.',
                        'description_en' => 'The eastern end opens to the vibrant area surrounding the Great Umayyad Mosque. A perfect spot to rest and admire this architectural masterpiece.',
                        'stop_duration' => 0.25,
                        'stop_order' => 3,
                        'latitude' => 33.5105,
                        'longitude' => 36.3050,
                    ],
                ];

                foreach ($stops as $stopData) {
                    $trip->stops()->create($stopData);
                }
            }

            if ($tripData['place_name'] === 'Damascus Citadel Tour') {
                $stops = [
                    [
                        'place_name' => 'Eastern Gate - Stone Muqarnas',
                        'place_name_ar' => 'البوابة الشرقية - المقرنص الحجري',
                        'place_name_en' => 'Eastern Gate - Stone Muqarnas',
                        'description' => 'The most artistically magnificent gate of the citadel, featuring the first stone muqarnas (stalactite vaulting) in Damascus. Beautifully painted with decorative motifs from Ayyubid, Mamluk, and Ottoman periods.',
                        'description_ar' => 'أجمل أبواب القلعة فنياً، وتتميز بأول مقرنص حجري في دمشق. مزينة بألوان زاهية وزخارف من العصور الأيوبية والمملوكية والعثمانية.',
                        'description_en' => 'The most magnificent gate with the first stone muqarnas in Damascus. Painted with motifs from Ayyubid, Mamluk, and Ottoman periods.',
                        'stop_duration' => 0.5,
                        'stop_order' => 1,
                        'latitude' => 33.5125,
                        'longitude' => 36.3025,
                    ],
                    [
                        'place_name' => 'Vaulted Hall & Ayyubid Towers',
                        'place_name_ar' => 'القاعة المقببة والأبراج الأيوبية',
                        'place_name_en' => 'Vaulted Hall & Ayyubid Towers',
                        'description' => 'A nine-vaulted hall once thought to be a throne room, now believed a multi-purpose space. The surrounding towers contain arrow slits, trebuchet platforms, and underground chambers.',
                        'description_ar' => 'قاعة ذات تسع قباب اعتُقد أنها قاعة العرش، ويعتقد الآن أنها كانت مساحة متعددة الاستخدامات. تحتوي الأبراج المحيطة على مزاغل للسهام ومنصات للمقاليع وغرف تحت الأرض.',
                        'description_en' => 'A nine-vaulted hall once thought to be a throne room. Towers contain arrow slits, trebuchet platforms, and underground chambers.',
                        'stop_duration' => 0.75,
                        'stop_order' => 2,
                        'latitude' => 33.5120,
                        'longitude' => 36.3028,
                    ],
                    [
                        'place_name' => 'Northern Wall & City Panorama',
                        'place_name_ar' => 'السور الشمالي وإطلالة المدينة',
                        'place_name_en' => 'Northern Wall & City Panorama',
                        'description' => 'Walk along the northern curtain wall overlooking where the Barada River once flowed. Enjoy panoramic views of Old Damascus including the Umayyad Mosque, Al-Hamidiyah Souq, and surrounding quarters.',
                        'description_ar' => 'تجول على طول السور الشمالي المطل على مجرى نهر بردى القديم. استمتع بإطلالات بانورامية على دمشق القديمة بما فيها الجامع الأموي وسوق الحميدية والأحياء المحيطة.',
                        'description_en' => 'Northern wall walk with panoramic views of Old Damascus including the Umayyad Mosque and Al-Hamidiyah Souq.',
                        'stop_duration' => 0.5,
                        'stop_order' => 3,
                        'latitude' => 33.5130,
                        'longitude' => 36.3020,
                    ],
                ];

                foreach ($stops as $stopData) {
                    $trip->stops()->create($stopData);
                }
            }
        }
    }
}
