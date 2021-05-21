<?php

use Illuminate\Database\Seeder;

class RevisingGuidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       \Illuminate\Support\Facades\DB::statement("
               
INSERT INTO `revising_guid` (`id`, `code`, `code_alias`, `name`, `name_alias`, `isText`, `mark`, `AddedByUser`, `default_status`, `default_reference`, `first_note`, `second_note`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'ع1', NULL, 'صور من الأوراق الرسمية للمنشأة', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, '2020-12-06 15:28:18'),
(2, 'ع1-1', NULL, 'السجل التجاري', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, '2021-04-01 08:15:32'),
(3, 'ع1-2', NULL, 'عقد تأسيس الشركة وتعديلاته', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, '2020-12-04 13:57:20'),
(4, 'ع1-3', NULL, 'ترخيص المزاولة مختوم', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, '2020-12-04 22:28:17'),
(5, 'ع1-4', NULL, 'صور هويات الشركاء / صاحب المؤسسة', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(6, 'ع1-5', NULL, 'صور أخر شهادة زكاة شرعية (شركة / مؤسسة)', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(7, 'ع1-6', NULL, 'شهادة التأمينات بإجمالي الرواتب قيمة وعدد', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(8, 'ع1-7', NULL, 'بيان الاستيراد من الجمارك', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(9, 'ع1-8', NULL, 'خلفية عن نشاط العميل وفروعه', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(10, 'ع1-9', NULL, 'تفويض برفع القوائم المالية عبر الموقع الالكتروني بوزارة التجارة', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(11, 'ع1-10', NULL, 'خطاب عدم مزاولة نشاط', '', NULL, 100, 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
(107, 'ن1', NULL, 'نموذج استقلال فريق عمل المراجعة', '', NULL, 100, 0, 1, NULL, 'يقوم كل موظف من أفراد فريق عمل المراجعة بتعبئة هذا النموذج ومرفقاته قبل بدء عملية المراجعة ويحفظ فى الملف الدائم للعملية ويتم تحديثه قبل بداية المراجعة لكل سنة مالية.\nلقد قرأت وفهمت سياسات المكتب وإجراءاتة الخاصة بالاستقلال وأؤكد بهذا ان المعلومات والبيانات الموضحة ادناه عن السنة المالية المنتهية في تاريخ القوائم المالية طبقا لافضل علمي صحيحة واكون مسؤولا مسؤولية كاملة إذا تبين خلاف ذلك . وفى حالة الإجابة بنعم يتم تحديد ومناقشة تلك المصلحة مع الشريك المسؤول عن العملية وتحديد الاجراء اللازم', NULL, NULL, NULL, '2021-03-10 17:16:30'),
(110, 'ن1-1', NULL, 'تم الإطلاع على قواعد الاستقلال وتفسيراته طبقا لما تتطلبه الأنظمة واللوائح ذات العلاقة بالمهنة والمعايير والقواعد المهنية الصادرة عن الهيئة السعودية للمحاسبين القانونيين والتشريعات الأخرى ذات العلاقة ؟', NULL, 0, 100, 0, 1, 'ع1-1', '', '', 107, NULL, '2020-12-31 01:24:14'),
(111, 'ن1-2', NULL, 'تم مراجعه قائمة أسماء المؤسسين وأعضاء مجلس الإدارة والمدراء التنفيذيين والشركاء للعميل بتاريخ القوائم المالية لمعرفة ما إذا كان هناك عمليات أو علاقات تخل بمتطلبات الاستقلال.', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(112, 'ن1-3', NULL, 'هل أحد المؤسسين أو أعضاء مجلس الإدارة أو المدراء التنفيذيين التالية أسمائهم للعميل قريبا لك من الدرجة الرابعة (يتعين تعبئة النموذج (2/1) قبل الإجابة على هذا السؤال)', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(113, 'ن1-4', NULL, 'ليس للمكتب او احد موظفية يعتبر  / يقدم / يمتلك / \r\nمساهما في تأسيس المنشأة وليس عضوا لمجلس الإدارة / أي خدمات إستشارية وإدارية / اسهم ذات شأن', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(114, 'ن1-5', NULL, 'هل أنت شريكا لأحد موظفي العميل الرئيسيين ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(115, 'ن1-6', NULL, 'هل أنت شريكا لأحد كبار شركاء العميل ؟ ', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(116, 'ن1-7', NULL, 'هل أنت شريكا للعميل نفسه ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(117, 'ن1-8', NULL, 'هل أنت ناظرا لوقف للعميل حصة فيه ؟ ', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(118, 'ن1-9', NULL, 'هل أنت وصيا على تركة للعميل حصة فيها ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(119, 'ن1-10', NULL, 'هل لديك قرض أو قروض من العميل ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(120, 'ن1-11', NULL, 'هل لديك قرضا أو قروض من أحد مدراء العميل ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(121, 'ن1-12', NULL, 'هل لديك قرض أو قروض من أحد أعضاء مجلس إدارة العميل ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(122, 'ن1-13', NULL, 'هل لديك قرض أو قروض من أحد المساهمين ذوى الشأن في المنشأة ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(123, 'ن1-14', NULL, 'هل تمتلك شركة يشابه نشاطها نشاط العميل ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(124, 'ن1-15', NULL, 'هل أنت عضو في مجلس إدارة إحدى الشركات التي يشابه نشاطها نشاط العميل ؟', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(125, 'ن1-16', NULL, 'هل أتعاب المراجعة وكافة المصروفات الجارية التى تم دفعها بواسطة ذلك العميل ليست بالقيمة التى تضعف من موضوعية أداء واستقلالية فريق العمل من المراجعين', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(126, 'ن1-17', NULL, 'فريق العمل ليس على علم بأى نزاع أو تعارض مصالح مع ذلك العميل / أو بين ذلك العميل وأى شخص آخر فى مكتبنا', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(127, 'ن1-18', NULL, 'لاتوجد أتعاب مستحقة طرف العميل قد تؤثر فى موضوعية أداء المكتب واستقلاليته', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(128, 'ن1-19', NULL, 'لايوجد نزاع قضائى جارى بين العميل والمكتب', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(129, 'ن1-20', NULL, 'فريق العمل يعلم طبيعة نشاط العميل و لديه الخبرة الكافية للقيام بتلك الخدمة', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(130, 'ن1-21', NULL, 'فريق العمل يستوعب العميل ولديهم القناعة بأنه يمكن الاستمرار فى التعامل مع العميل  ', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(131, 'ن1-22', NULL, 'لايوجد موظف فى منشأة العميل كان شريكاً أو من كبار موظفي المكتب لدينا أو من المحتمل أن يكون كذلك بالإضافة الي ان اعمال الحسابات والأعمال الاخرى التى تتم نيابة عن العميل من إعداد وضبط للقوائم المالية هى أعمال مقبولة من قبلهم والمكتب لم يلعب دور الإدارة لهم وقد تم تخطيط اختبارات المراجعة لتغطى الاعمال المكلفين بها لإبداء الرأي في صحة هذة القوائم المالية', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(132, 'ن1-23', NULL, 'فريق العمل وعائلاتهم لديهم استقلال تام عن العميل ', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(133, 'ن1-24', NULL, 'لاتوجد ارتباطات مالية بين فريق العمل وبين العميل', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(134, 'ن1-25', NULL, 'وقد اقر فريق العمل بالعلم على السياسات الخاصة بالاستقلالية والتي يتبعها المكتب  راجع نموذج رقم ( ن/1)', '', NULL, 100, 0, 1, NULL, '', '', 107, NULL, NULL),
(135, 'ن2', NULL, 'نموذج قبول العملاء واستمرارية العلاقة معهم', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 'ن2-1', NULL, 'وصف وطبيعة نشاط العميل', NULL, 0, 100, 0, 1, 'ع1-4', NULL, NULL, 135, NULL, '2021-01-03 16:44:43'),
(137, 'ن2-2', NULL, 'الكيان القانوني للمنشأة', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(138, 'ن2-3', NULL, 'بيانات الملاك الرئيسيون ، المديرون التنفيذيون ، أعضاء مجلس الإدارة', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(139, 'ن2-4', NULL, 'علاقات الارتباط بين المنشأة والافراد', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(140, 'ن2-5', NULL, 'نزاهة الإدارة والملاك', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(141, 'ن2-6', NULL, 'الخلافات فى الرأي حول معايير المحاسبة أو المراجعة ', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(142, 'ن2-7', NULL, 'خلافات حول الأتعاب', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(143, 'ن2-8', NULL, 'وصف علاقات تعامل العميل بالمؤسسات المالية (البنوك):', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(144, 'ن2-8-1', NULL, 'نتائج الاستفسار					\r\n', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(145, 'ن2-8-2', NULL, 'نوع الحساب', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(146, 'ن2-8-3', NULL, 'اسم المسئول عن الحساب والهاتف', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(147, 'ن2-9', NULL, 'وصف نوع الخدمات التي سيقدمها المكتب لهذا العميل :', '', NULL, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(148, 'ن2-9-1', NULL, 'نوع الخدمة', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(149, 'ن2-9-2', NULL, 'مــدى تكرارهــا', '', 2, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(150, 'ن2-9-3', NULL, 'المستفيدين الأساسيين من الخدمة التى ستقدم (خاصة فى الخدمات الأخرى  غير  عملية المراجعة)', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(151, 'ن2-10', NULL, 'الاطلاع علي آخر قوائم مالية وإقرارات زكوية وضريبية وتوضيح النتائج : البند الذي تم فحصــــه', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(152, 'ن2-11', NULL, 'وصف اي مشاكل تتعلق بالشك فى الاستمرارية ؟ ', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(153, 'ن2-12', NULL, 'وصف أي تغيرات رئيسية في المعلومات السابقة منذ آخر تقييم تم للعميل وأي أمـور أخرى عرفناها كانت ستستدعى رفضنا لهذا العميل لو كنا على علم بها عند قوبلنا', '', 1, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(154, 'ن2-13', NULL, 'هل لدينا علم بأي خلافات مهمة بين الإدارة أو الملاك والمراجع السابق  ؟ ', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(155, 'ن2-14', NULL, 'هل هنـاك ما يدل على  حدوث أي مشاكل محتملة في تحصيل الأتعاب  ؟', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(156, 'ن2-15', NULL, 'هل تفوق احتياجات العميل إمكانياتنا الفنية أو قدرة منسوبينا  ؟', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(157, 'ن2-16', NULL, 'هل نحـن نعلم بأي مشاكل متعلقة بالاستقلال قد تؤثر على قدرتنا على مقابلة  احتياجات العميل ؟', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(158, 'ن2-17', NULL, 'هل هناك عوامل مخاطرة عالية مرتبطة بالعملية قد تؤثر على قرارنا في قبول  العميل ؟', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(159, 'ن2-18', NULL, 'هل هناك مشكلة محتملة مع الإدارة أو الملاك لعدم فهمهم فهما كاملا للقيود على الخدمات التي سنقدمها (مثلا توقع الإدارة أننا سنكون مسئولين عن إكتشاف الغش', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(160, 'ن2-19', NULL, 'هل هناك مشكلة محتملة مع الإدارة أو الملاك لعدم فهمهم فهما كاملا للقيود على الخدمات التي سنقدمها (مثلا توقع الإدارة أننا سنكون مسئولين عن إكتشاف الغش', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(161, 'ن2-20', NULL, 'استخدام مستشارين خارجيين', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(162, 'ن2-21', NULL, 'تخصيص مساعدين اكثر خبرة', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(163, 'ن2-22', NULL, 'الحصول على الاتعاب مقدما																\n', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(164, 'ن2-23', NULL, 'قرار القبـول', '', 0, 100, 0, 1, NULL, NULL, NULL, 135, NULL, NULL),
(165, 'ن3', NULL, 'خطاب المحاسب السابق', '', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'ن4', NULL, 'خطاب الإرتباط ', '', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-29 12:37:51'),
(167, 'ن5', NULL, 'ميزان المراجعه', NULL, NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-30 21:27:29'),
(168, 'ن6', NULL, 'تخطيط عملية المراجعة', '', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'ن6-1', NULL, 'خلفية عن العميل و نشاطه و فروعه و حساباته و اسم صاحب المؤسسة و رأس المال', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 168, NULL, NULL),
(171, 'ن6-2', NULL, 'بيانات عن العاملين الرئيسيين لدى العميل وكيفية الإتصال بهم:', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 168, NULL, NULL),
(172, 'ن6-3', NULL, '\'وصف مختصر عن النظام المحاسبى وأية تغييرات حدثت فيه:', '', NULL, 100, 0, NULL, NULL, '                                        النظام المحاسبي المستخدم نظامي اّلي يقوم بمجرد حفظ القيد بالترحيل الالي والتاثير على الحسابات الختامية والحسابات الفرعية لبنود الحسابات الرئيسية\n', NULL, 168, NULL, NULL),
(173, 'ن6-4', NULL, 'أى بنود هامة وردت ضمن خطاب التكليف والتى تتطلب الاهتمام بها:', '', 1, 100, 0, NULL, NULL, NULL, NULL, 168, NULL, NULL),
(174, 'ن6-5', NULL, 'فريق المراجعة والمراجعون المشاركون:', '', 1, 100, 0, NULL, NULL, NULL, NULL, 168, NULL, NULL),
(175, '5.1', NULL, 'الإلتزام بالإستقلالية:', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 174, NULL, NULL),
(176, '5.2', NULL, 'المساعدة التي سيقدمها العميل في أعمال المراجعة:', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 174, NULL, NULL),
(177, '5.21', NULL, 'تقديم كافة البيانات و المعلومات و السجلات المحاسبية التي تساعدنا في إنجاز مهمتنا', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(178, '5.22', NULL, ' إعداد موازين المراجعة بالمجاميع و الأرصدة', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(179, '5.23', NULL, 'إعداد كشوف لجميع الحسابات بميزان المراجعة توضح مفردات كل حساب بحيث يطابق إجمالي الرصيد للحساب المبلغ المعروض في ميزان المراجعة', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(180, '5.24', NULL, 'إعداد مذكرة تسوية الصنادق ومحاضر الجرد ', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(181, '5.25', NULL, 'إعداد مذكرات بتسوية حسابات البنوك شهرياً', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(182, '5.26', NULL, 'إعداد بيانات تحليلية عن الأصول الثابتة وتفاصيل الإضافات والإستبعادات والإستهلاكات', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(183, '5.27', NULL, 'إعداد كشوف المخزون', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(184, '5.28', NULL, 'عرض المستندات المؤيدة للمعاملات والأرصدة للإطلاع عليها وفحصها وتقديم نسخ ضوئية منها عند الطلب للإحتفاظ بها في ملف المراجعة', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 176, NULL, NULL),
(185, '5.3', NULL, 'الاتفاق مع العميل على مكان مناسب لفريق المراجعة و الأجهزة المطلوبة:', '', 1, 100, 0, NULL, NULL, NULL, NULL, 174, NULL, NULL),
(186, '5.4', NULL, 'المواعيد الهامة:', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 174, NULL, NULL),
(187, '5.41', NULL, 'خطاب الارتباط', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(188, '5.42', NULL, 'تاريخ انتهاء أعمال التخطيط', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(189, '5.43', NULL, 'العمل الميداني المرحلي', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(190, '5.44', NULL, 'العمل الميداني النهائي', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(191, '5.45', NULL, 'تقرير مراقبي الحسابات', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(192, '5.46', NULL, 'خطاب الإدارة', '', NULL, 100, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL),
(193, 'ن7', NULL, 'ساعات الموازنة للسنة الحالية', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(194, 'ن8', NULL, 'فهرس علامات المراجعة ', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(195, 'ن8-1', '1', 'الرصيد مطابق لميزان المراجعة', '', NULL, 0, 0, 1, NULL, 'كشوفات الحساب التحليلية', NULL, 194, NULL, NULL),
(196, 'ن8-2', '2', 'الرصيد مطابق لميزان المراجعة ويوجد مستند خارجي مؤيد للرصيد', '', NULL, 0, 0, 1, NULL, 'مصادقات ومطابقات البنوك والارصدة المدينة والدائنة', NULL, 194, NULL, NULL),
(197, 'ن8-3', '3', 'الرصيد مطابق لميزان المراجعة ويوجد مستند داخلي مؤيد للرصيد', '', NULL, 0, 0, 1, NULL, 'اعتماد مجلس الإدارة', NULL, 194, NULL, NULL),
(198, 'ن8-4', '4', 'الرصيد غير مطابق  ', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(199, 'ن8-5', '5', 'تم المطابقة مع الميزان والميزانية', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(200, 'ن8-6', '6', 'تاكيدات اضافية', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(201, 'ن8-7', '7', 'تم التحقق من المؤيدات المستندية', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(202, 'ن8-8', '8', 'تم التاكد من الوجود', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(203, 'ن8-9', '9', 'تم التاكد من الاكتمال', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(204, 'ن8-10', '10', 'تم التاكد من الملكية', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(205, 'ن8-11', '11', 'تم التاكد من التقييم', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(206, 'ن8-12', '12', 'التحقق من صحة الاحتساب ', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(207, 'ن8-13', '13', 'تم التاكد من العرض و الافصاح المناسب', '', NULL, 0, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(208, 'ن8-14', '14', 'أدوات ربط', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 194, NULL, NULL),
(209, 'ن9', NULL, 'سجل تواقيع رموز فريق العمل بالمكتب', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 'ن10', '', 'فهرس برنامج المراجعة الشامل', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, '2020-12-06 15:28:18'),
(211, 'ن11', '', 'مسودة القوائم المالية من العميل', '', NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, '2020-12-06 15:28:18'),
(213, 'ن13', NULL, 'المراجعة التحليلية وبعض النسب المالية', NULL, NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, '2020-12-30 01:45:39'),
(214, 'ن14', NULL, 'قوائم العرض والإفصاح العام', NULL, NULL, 100, 0, 1, NULL, NULL, NULL, NULL, NULL, '2020-12-30 01:45:31'),
(215, 'ن14-1', NULL, ' المجموعة الكاملة للقوائم المالية', NULL, 0, 100, 0, 1, 'ع1-2', NULL, NULL, 214, NULL, '2020-12-31 01:14:16'),
(216, 'ن14-1-1', NULL, 'قائمة المركز المالي', NULL, 0, NULL, 0, 1, 'ع1', NULL, NULL, 215, NULL, '2020-12-31 01:07:04'),
(217, 'ن14-1-2', NULL, 'قائمة الدخل', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 215, NULL, NULL),
(218, 'ن14-1-3', NULL, 'قائمة التغير في حقوق الملكية', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 215, NULL, '2020-12-30 23:16:15'),
(219, 'ن14-2', NULL, ' الأسس العامة لعرض المعلومات', '', 0, 100, 0, 1, NULL, NULL, NULL, 214, NULL, NULL),
(220, 'ن14-2-1', NULL, 'تبويب عناصر المركز المالي بطريقة تكفل تسهيل استيعاب المعلومات المهمة التي تشملها تلك القوائم', '', 0, 100, 0, 1, NULL, NULL, NULL, 219, NULL, NULL),
(221, 'ن14-2-2', NULL, 'تم مقارنة السنة الحالية بسنة سابقة', '', 0, 100, 0, 1, NULL, NULL, NULL, 219, NULL, NULL),
(222, 'ن14-2-3', NULL, 'الإيضاحات المرفقة بالقوائم المالية تم إعطائها عناوين يوضح كل عنوان ما يحتويه الإيضاح من معلومات', '', 0, 100, 0, 1, NULL, NULL, NULL, 219, NULL, NULL),
(223, 'ن14-3', NULL, 'متطلبات العرض العام للقوائم المالية كل على حدة', '', 0, 100, 0, 1, NULL, NULL, NULL, 214, NULL, NULL),
(224, 'ن14-3-1', NULL, ' هل تتضمن قائمة المركز المالي كافة الأصول والخصوم وعناصر حقوق أصحاب رأس المال ', '', 0, 100, 0, 1, NULL, NULL, NULL, 223, NULL, NULL),
(225, 'ن14-3-2', NULL, ' هل تم إبراز المجموعات التالية للأصول وحسب الترتيب في قائمة المركز المالي :', '', 0, 100, 0, 1, NULL, NULL, NULL, 223, NULL, NULL),
(226, 'ن14-3-2-1', NULL, '\r\nأ-الأصول المتداولة\r\n', '', 0, 100, 0, 1, NULL, NULL, NULL, 225, NULL, NULL),
(227, 'ن14-3-2-2', NULL, 'ب-الاستثمارات والأصول المالية', '', 0, 100, 0, 1, NULL, NULL, NULL, 225, NULL, NULL),
(228, 'ن14-3-2-3', NULL, 'ج-الأصول غير الملموسة', '', 0, 100, 0, 1, NULL, NULL, NULL, 225, NULL, NULL),
(229, 'ن14-3-3', NULL, 'هل تم إبراز المجموعات التالية للخصوم وحسب الترتيب التالي في قائمة المركز المالي :', '', 0, 100, 0, 1, NULL, NULL, NULL, 223, NULL, NULL),
(230, 'ن14-3-3-1', NULL, 'أ-الخصوم المتداولة', '', NULL, 100, 0, 1, NULL, NULL, NULL, 229, NULL, NULL),
(231, 'ن14-3-3-2', NULL, 'ب-الخصوم غير المتداولة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 229, NULL, NULL),
(232, 'ن14-3-4', NULL, 'هل تم إبراز المجموعات التالية لحقوق رأس المال  وحسب الترتيب التالي في صلب قائمة المركز المالي :', '', 0, 100, 0, 1, NULL, NULL, NULL, 223, NULL, NULL),
(233, 'ن14-3-4-1', NULL, 'أ- رأس المال', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 232, NULL, NULL),
(234, 'ن14-3-4-2', NULL, 'ب- الاحتياطي النظامي', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 232, NULL, NULL),
(235, 'ن14-3-4-3', NULL, 'ج- الأرباح ( الخسائر) المبقاة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 232, NULL, NULL),
(237, 'ن14-4', NULL, 'هل تم إظهار نتائج أعمال الوحدة المحاسبية المكونات التالية', '', 0, 100, 0, 1, NULL, NULL, NULL, 214, NULL, NULL),
(238, 'ن14-4-1', NULL, 'نتائج الأنشطة المستمرة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 237, NULL, NULL),
(239, 'ن14-4-2', NULL, 'نتائج الأنشطة غير المستمرة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 237, NULL, NULL),
(241, 'ن14-4-3', NULL, ' هل تم إبراز البنود التالية كبنود مستقلة :', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 237, NULL, NULL),
(242, 'ن14-3-3-1', NULL, 'أ- صافي المبيعات ( أو صافي الإيرادات ) من العمليات الرئيسية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(243, 'ن14-3-3-2', NULL, 'ب- تكلفة المبيعات (أ وتكلفة الإيرادات )', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(244, '', NULL, 'ج – مجمل الدخل من العمليات الرئيسية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(245, '', NULL, 'د- المصروفات الإدارية والعمومية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(246, NULL, NULL, 'هـ- الاستهلاك والاطفاء', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(247, '', NULL, 'و- الإيرادات الأخرى', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(248, '', NULL, 'ز- الأرباح ( الخسائر ) الرأسمالية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(249, '', NULL, 'ح- المصروفات الأخرى', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 241, NULL, NULL),
(250, 'ن14-5', 'u2', '', 'عرض المعلومات في قائمة التدفق', 0, 100, 0, 1, NULL, NULL, NULL, 214, NULL, '2020-12-31 06:35:14'),
(251, 'ن14-5-1', NULL, 'هل تم عرض ما يلي في القائمة', '', 0, 100, 0, 1, NULL, NULL, NULL, 250, NULL, NULL),
(252, NULL, NULL, 'أ‌-التدفق النقدي من الأنشطة التشغيلية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 251, NULL, NULL),
(253, NULL, NULL, 'ب‌-التدفق النقدي من الأنشطة الاستثمارية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 251, NULL, NULL),
(254, NULL, NULL, 'ج-التدفق النقدي من الأنشطة التمويلية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 251, NULL, NULL),
(255, 'ن14-6', NULL, '', 'عرض المعلومات في قائمة الأرباح ( الخسائر) المبقاة', 0, 100, 0, 1, 'ع1', NULL, NULL, 214, NULL, '2020-12-31 06:27:02'),
(256, 'ن14-6-1', NULL, 'هل تم عرض ما يلي في القائمة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 255, NULL, NULL),
(258, NULL, NULL, ' أرصدة اول المدة من الأرباح (الخسائر) المبقاة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 256, NULL, NULL),
(259, NULL, NULL, ' أرصدة أول المدة من رصيد الاحتياطيات', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 256, NULL, NULL),
(260, '', NULL, ' تسويات سنوات سابقة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 256, NULL, NULL),
(261, 'ن14-7', NULL, 'هل تم الإفصاح عن البنود التالية :', '', 0, 100, 0, 1, NULL, NULL, NULL, 214, NULL, NULL),
(262, NULL, NULL, ' طبيعة نشاط المنشأة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL),
(263, NULL, NULL, 'السياسات المحاسبية الهامة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL),
(264, NULL, NULL, 'التغيرات المحاسبية بما في ذلك معالجتها المحاسبية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL),
(265, NULL, NULL, 'المكاسب والخسائر المحتملة بما في ذلك معالجتها المحاسبية', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL),
(266, NULL, NULL, 'الارتباطات المحتملة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL),
(267, NULL, NULL, 'الأحداث اللاحقة', '', NULL, NULL, 0, 1, NULL, NULL, NULL, 261, NULL, NULL)
           ");
    }
}
