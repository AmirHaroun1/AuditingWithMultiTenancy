<?php

use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
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
        
            INSERT INTO `documents` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
            (1, 'السجل التجاري', 'ع1-1', NULL, NULL),
            (2, 'عقد تأسيس الشركة وتعديلاته', 'ع1-1', NULL, NULL),
            (3, 'ترخيص المزاولة مختوم', 'ع1-3', NULL, NULL),
            (5, 'صور هويات الشركاء / صاحب المؤسسة', 'ع1-4', NULL, NULL),
            (6, 'صور أخر شهادة زكاة شرعية (شركة / مؤسسة)', 'ع1-5', NULL, NULL),
            (7, 'شهادة التأمينات بإجمالي الرواتب قيمة وعدد', 'ع1-6', NULL, NULL),
            (8, 'بيان الاستيراد من الجمارك', 'ع1-7', NULL, NULL),
            (9, 'خلفية عن نشاط العميل وفروعه', 'ع1-8', NULL, NULL),
            (10, 'تفويض برفع القوائم المالية عبر الموقع الالكتروني بوزارة التجارة', 'ع1-9', NULL, NULL),
            (11, 'خطاب عدم مزاولة نشاط', 'ع1-10', NULL, NULL),
            (12, 'خطاب المحاسب السابق', 'ن3', NULL, NULL),
            (13, 'خطاب الإرتباط', 'ن4', NULL, NULL),
            (14, 'ميزان المراجعه', 'ن5', NULL, NULL);

        ");
    }
}
