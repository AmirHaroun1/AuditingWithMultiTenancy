<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>خطاب الأرتباط</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="window.print()" style="font-weight: bold">
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class=" text-center" >

                   <strong>
                       خطاب ارتباط
                    </strong>
                </h2>
                <h2 class=" text-center" >
                    <strong style="padding-top: 20px">
                        Engagement letter

                    </strong>
                </h2>
                <h2 class=" text-center" >

                    <strong style="margin-top: 20px;padding:8px;background-color: #95B3D7">
                        رقم
                        {{$Institution->number}}
                    </strong>
                </h2>

                <p class="page-header" >
                </p>
            </div><!-- /.col -->
            <hr>

        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <!-- signature table -->

            <div class="col-md-12">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 14px"><h5 class="pull-left">Attention/</h5></td>
                        <td></td>
                        <td style="width: 50%"><h3 class="pull-right">{{$Institution->name}}</h3></td>
                        <td style="width: 14px"><h5 class="pull-right">السادة</h5></td>

                    </tr>
                        <tr>
                            <td style="width: 14px"><h5 class="pull-left">MR/</h5></td>
                            <td></td>
                            <td style="width: 50%"><h3 class="pull-right">{{$Institution->agent->name}}</h3></td>
                            <td style="width: 14px"><h5 class="pull-right">عناية</h5></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.signature table -->

            <!-- First table -->

            <div class="col-md-12">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>

                    </tr>
                    </thead>
                    <tbody>
                    <!---first Row ------>

                    <tr>
                        <td style="width: 50%"><h5 class="pull-left text-left">
                                You have requested that we Submit a review of the financial statements (Statement of financial position, Income statements and changes in partner's rights and Cash Flows) for the company of the financial statements  year which ending on 31/12/2017.
                                We are pleased to offer you under our letter our offer for the purpose of expressing our opinion on the Company's financial statements.

                            </h5></td>
                        <td style="width: 50%"><h5 class="pull-right text-right">
                                بناءً على طلبكم منا تقديم عرض لمراجعة القوائم المالية (قائمة المركز المالي وقوائم الدخل والتغييرات في حقوق الشركاء والتدفقات النقدية)
                                للشركة للسنة المالية المنتهية في
                                يسرنا أن نقدم لكم بموجب هذا الخطاب عرضنا التالي لغرض إبداء رأينا حول القوائم المالية للشركة
                            </h5></td>

                    </tr>
                    <!---/. first Row ------>

                    <!---second Row ------>

                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h4 class="pull-left text-left">Date : {{$Transaction->engagement_letter_Date}}</h4></td>
                        <td style="width: 50%;background-color: #95B3D7">
                            <h4 class="text-right">
                                التاريخ:
                                    {{$Transaction->hijri_engagement_letter_Date}}
                            </h4>
                        </td>
                    </tr>

                    <!---/. second Row ------>

                    <!--- Third Row ------>

                    <tr>
                        <td style="width: 50%">
                            <h4 class="text-left">
                                    Audit Responsibilities and Limits
                            </h4>
                            <h5>
                                Our mission is to provide an independent report to our partners showing whether the financial statements as a whole:

                                <ol style="padding-top: 10px">
                                    <li style="padding-top: 4px">Present fairly, in all substantial ways the financial position as in 31/12/2017 and the results of its operations and its cash flows of the year ended in that date according to the generally accepted accounting standards in the Kingdom of Saudi Arabia.</li>
                                    <li style="padding-top: 10px">	Consistent with the Saudi Companies Regulations and the Company's establishment contract regarding to the preparation of financial statements</li>

                                </ol>
                            </h5>
                        </td>
                        <td style="width: 50%" class="text-right">
                            <h4 class="text-right">
                                مسئوليات وحدود المراجعة
                            </h4>
                            <h5>
                                تقتضي مهمتنا تقديم تقرير مستقل للشركاء نبين فيه فيما إذا كانت القوائم المالية ككل:
                                <ol style="padding-top: 10px" dir="rtl">
                                    <li style="padding-top: 4px">
                                        تظهر بعدل من كافة النواحي الجوهرية المركز المالي كما في
                                        ونتائج أعمالها وتدفقاتها النقدية للسنة المالية المنتهية في ذلك التاريخ وفقاً لمعايير المحاسبة المتعارف عليها في المملكة العربية السعودية.
                                    </li>
                                    <li style="padding-top: 10px">تتفق مع نظام الشركات السعودي وعقد تأسيس الشركة فيما يتعلق بإعداد القوائم المالية</li>

                                </ol>
                            </h5>
                        </td>
                    </tr>

                    <!---/.third Row ------>

                    <!---Fourth Row ------>
                    <tr>
                        <td>
                            <h5 class="pull-left text-left">We will review in accordance with the approved  International Standards on Auditing for Implementation in the Kingdom of Saudi Arabia that require from us to plan and perform the audit to obtain reasonable assurance about whether the financial statements are free from material misstatement.
                                An audit involves examining evidence on a pro-rata basis supporting the amounts and disclosures the financial statements. An audit also includes assessing the estimates made by management, as well as evaluating the overall financial statements presentation
                                The in Saudi Arabia require that we obtain reasonable, rather than, absolute, degree of Contentment That the financial statements do not contain material misstatement, whether due to an error or a breach. An effective internal control system reduces the likelihood of errors or irregularities
                                (Possibly misuse of assets) Without being detected even It does not prevent such a possibility. It does not prevent such a possibility.
                                For this reason, we are using selected tests in the audit work Our audit work should not be relied upon to detect misappropriations or other irregularities that may occur, which are discovered, if any, as a result of our examination and then will be notified of such cases.
                                In accordance with generally accepted Auditing standards professional standards, in exceptional cases where we are unable to complete the audit or to form an opinion or in a situation in which we are unable to render an opinion, we may refrain from expressing an opinion or issuing a report.
                                As part of our audit, we will obtain an understanding of the company internal control structure solely to plan the audit and determine the nature, timing and extent of our audit procedures. This understanding will not be sufficient to enable us to render a separate opinion on the effectiveness of the internal control structure over financial reporting. The working papers prepared in conjunction with our work are the property of our firm, constitute confidential and proprietary information and it will be retained by us in accordance with our firm's policies and procedures.
                                At the highest level, we study and evaluate the IT environment and regulatory procedures to help us assess the effectiveness and effectiveness of the audit procedures on important accounting applications and the closure of the Company's financial statements.
                            </h5>
                        </td>
                        <td>
                            <h5 class="pull-right text-right">
                                ستتم مراجعتنا وفقاً للمعايير الدولية للمراجعة المعتمدة للتطبيق في المملكة العربية السعودية والتي تتطلب منا القيام بتخطيط وتنفيذ أعمال المراجعة للحصول على قناعة معقولة بأن القوائم المالية خالية من أخطاء جوهرية.
                                تشتمل إجراءات المراجعة على فحص الأدلة على أساس العينة المؤيدة للمبالغ والإفصاحات التي تتضمنها القوائم المالية. كما تشتمل على تقويم المبادئ المحاسبية المتبعة والتقديرات الهامة المطبقة من قبل الإدارة وتقويم العرض العام للقوائم المالية.
                                تتطلب معايير المراجعة المتعارف عليها في المملكة العربية السعودية الحصول على درجة معقـــــولة وليـست مطلقة – من القناعة بأن القوائم المالية لا تتضمن خطأً جوهرياً سواء كان بسبب خطأ أو مخالفة، إن وجود نظام فعال للرقابة الداخلية يقلل من احتمال حدوث أخطاء أو مخالفات (ربما في ذلك سوء استخدام الموجودات) بدون اكتشافها، إلا أنه لا يحول دون وقوع مثل هذا الاحتمال. ولهذا السبب، ونظراً لأننا نقوم باستخدام اختبارات مختارة في أعمال المراجعة فقد لا يتم اكتشاف خطأ جوهري وبالتالي لا نضمن اكتشاف كل الأخطاء أو المخالفات إن وجدت. عليه فإن أعمال المراجعة التي نقوم بها يجب ألاّ يُعوّل عليها في اكتشاف الاختلاسات أو المخالفات الأخرى التي قد تحدث، والتي يتم اكتشافها إن وجدت – نتيجة أعمال الفحص التي نقوم بها وعندها سيتم ابلاغكم بمثل هذه الحالات.
                                ووفقاً للمعايير المهنية، فإننا في الحالات غير العادية التي تعذر فيها علينا إتمام أعمال المراجعة أو تكوين رأي أو في الحالة التي لن نتمكن فيها من أصدرا رأي، يجوز لنا الامتناع عن إبداء رأي أو إصدار تقرير.
                                وكجزء من عملية المراجعة، سنقوم بالحصول على فهم لنظام الرقابة الداخلية للشركة وذلك لغرض التخطيط لأعمال المراجعة فقط لتحديد طبيعة وتوقيت ومدى إجراءات المراجعة التي نقوم بها. عليه فإن فهمنا هذا لن يكون كافياً لتمكيننا من تقديم رأي مستقل عن مدى كفاءة وفعالية نظام المراقبة الداخلية حول البيانات المالية. إن أوراق العمل المتعلقة بمراجعتنا هي ملك لمكتبنا، وتحتوي على معلومات سرية وسوف نحتفظ بها وفقاً للإجراءات والسياسات المتبعة لدينا.
                                كذلك نقوم وفق اعلى المستويات، بدراسة وتقييم بيئة تقنية المعلومات والإجراءات الرقابية وذلك لمساعدتنا  في تقييم مدي فعاليتها وفعالية الإجراءات الرقابية علي التطبيقات المحاسبية الهامة وإقفال القوائم المالية للشركة.

                            </h5>

                        </td>
                    </tr>
                    <!---/. Fourth Row ------>

                    <!-- Fifth Row ----->
                    <tr>
                        <td style="width: 50%" class="text-left">
                            <h4 class="text-left">
                                Management's Responsibilities and Representations
                            </h4>
                            <h5>
                                We remind you that, in accordance with the Regulations of companies and accepted auditing standards, it is the responsibility of the Company's management to prepare the financial statements including adequate disclosure. This includes the saving of adequate accounting records and internal controls, the selection of accounting policies, and the safeguarding of the assets of the company as part of our audit process, and according to the requirements of the accepted auditing standards  we will make specific inquiries to the management and others On the items included in the financial statements and the effectiveness of accounting operations We will ask Management for written assurance about the information provided to us regarding the audit. The results of the audit and management responses to our inquiries and the written assurance provided by management are evidence and evidence on which we base our professional judgment on the financial statements Due to the importance of oral or written assurance provided by the management to perform the audit effectively, the Company agrees to discharge the obligations and costs of the services we provide under this Letter of Appointment arising from any incorrect representations contained in the letter of assurance submitted by the Administration

                                We would also like to draw your attention to the fact that in accordance with certain accounting regulations, the Company shall:

                                <ol style="padding-top: 10px">
                                    <li style="padding-top: 4px">
                                        Preparation and submission of audited financial statements of the Ministry of Commerce within 45 days of the end of the financial year..
                                    </li>
                                    <li style="padding-top: 10px">
                                        To keep the minimum number of books and records in the Arabic language, if these books and records are held manually they  must be ratified by the Chamber of Commerce before use, either
                                    </li>

                                </ol>
                                If it is held on the computer, you must extract a copy of the data and information from the computer on a regular basis (every three months at least) and be certified by the auditors or the Ministry of Commerce..
                                if you request us , issue a confirmation report stating that the Company maintains accounting records in Arabic on the computer in the Kingdom of Saudi Arabia in accordance with the requirements of the Minister of Commerce decision No. 110 dated 24/12/1412 H. and Ministry of Finance and National Economy's Resolution No. 32/312 dated 27/01/1412H. If other governmental authorities have different requirements are not covered by the attestation report. Terms of this engagement shall be agreed separately.
                                to the extent finally determined to have cover all defalcations or other irregularities that may have occurred, but their discovery, if they resulted from fraudulent behavior or willful misconduct. A-Albakheet certified public Account maximum liability for any reason relating to the services under this letter shall be limited to the fees paid to the Office for the services or work product giving rise to liability. services under this letter,
                            </h5>

                        </td>
                        <td style="width: 50%" class="text-right">
                            <h4 class="text-right">
                                مسئوليات الإدارة وتأكيداتها
                            </h4>
                            <h5>
                                نود أن نُلفت الإنتباه الى أنه طبقاً لنظام الشركات السعودي ومعايير المراجعة المتعارف عليها، فإن مسئوليات إعداد القوائم المالية بما فيها الإفصاحات الملائمة تقع على عاتق الإدارة. ويشمل ذلك حفظ دفاتر وسجلات محاسبية منتظمة، وأنظمة الرقابة الداخلية، واختيار القوائم المالية وتطبيق السياسات المحاسبية الملائمة، وحماية موجودات الشركة كجزء من عملية المراجعة ووفقاً لمتطلبات معايير المراجعة المتعارف عليها، سنوجه إستفسارات محدّده إلى الإدارة وغيرها بشأن البنود المدرجة في القوائم المالية ومدي فعالية العمليات المحاسبية، وسنطلب من الإدارة تأكيدات خطيّة بشأن المعلومات المقدمة لنا والمتعلقة بالمراجعة تُعتبر نتائج إختبارات المراجعة وردود الإدارة على استفساراتنا والتأكيدات الخطيّة التي تقدمها الإدارة لنا بمثابة الأدلة والقرائن التي نعتمد عليها في تكوين رأينا المهني حول القوائم المالية. ونظراً لأهمية التأكيدات الشفهية أو الخطية التي تقدمها الإدارة للقيام بأعمال المراجعة بشكل فعّال، توافق الشركة على إبراء ذمة المكتب وموظفيه من الإلتزامات والتكاليف المتعلقة بالخدمات التي سنقدمها بموجب خطاب التعيين هذا والمترتبة على أية تأكيدات غير صحيحة قد يتضمنها خطاب التأكيدات المقدّم من قبل الإدارة.
                                كما نود أن نُلفت انتباهكم الي أنه يجب على الشركة وفقاً لبعض الأنظمة ذات العلاقة بالأمور المحاسبية القيام بـ :
                                <ol style="padding-top: 10px" dir="rtl">
                                    <li style="padding-top: 4px">
                                        إعداد وتقديم القوائم المالية المدقّقة لوزارة التجارة خلال 45 يوماً من تاريخ إنتهاء السنة المالية
                                    </li>
                                    <li style="padding-top: 10px">
                                        مسك الحد الأدنى من الدفاتر والسجلات المحاسبية باللغة العربية، فإذا كانت هذه الدفاتر والسجلات ممسوكة يدوياً يجب تصديقها من الغرفة التجارية قبل إستخدامها، أما
                                        إ ذا كانت ممسوكة على الحاسب الآلي، فيجب أن تستخرج نسخة من البيانات والمعلومات من الحاسب الآلي بصورة منتظمة (كل ثلاثة أشهر على الأقل) وتُصدّق من مراجعي الحسابات أو وزارة التجارة.
                                    </li>

                                </ol>
                                سنقوم- إذا ما طلبتم منا ذلك بإصدار تقرير تأكيدات على أن الشركة تحتفظ بسجلات محاسبية باللغة العربية على الحاسب الآلي في المملكة العربية السعودية طبقاً لمتطلبات قرار وزير التجارة رقم 110 وبتاريخ 24/12/1412هـ وقرار وزير المالية والإقتصاد الوطني رقم 312/32 وتاريخ 27/1/1412هـ أما بالنسبة للجهات الحكومية الأخرى التي لها متطلبات مختلفة بشأن الدفاتر والسجلات باللغة العربية فلن يتم الإشارة إلى هذه المتطلبات في تقريرنا للتأكيد وسيتم الإتفاق على الشروط المتعلقة بهذا التقرير بصورة مفصلة.
                                إن   حــدود    المسـئولية   الـــتي     يلتــزم بـها
                                مكـتب
                                {{$OfficeInfo->name}}
                                للمحاسبة والمراجعة لأي سبب   يتعـــلق بالخدمــات موضوع   هذا الخطاب لا تتجاوز باى حال من الأحوال قيمة الأتعاب المدفوعة للمكتب. عن الخدمات أو المنتج المسبب.
                            </h5>

                        </td>
                    </tr>
                    <!--- /.fifth Row ---->

                    <!---sixth Row ------>
                    <tr>
                        <td>
                            <h4 class="text-left">Commitments</h4>
                            <h5 class=" text-left">

                                This engagement letter reflects the entire agreements between the company and  {company name} certified public Account Office relating to the services covered by this letter. It replaces and suspends any previous proposals, correspondence and understandings, whether written or oral. The agreements contained herein shall survive the completion of termination of the matters which are the subject of this letter.
                                This letter will be effective for future years unless we amend the terms of our engagement in writing.

                            </h5>
                        </td>
                        <td>
                            <h4 class="text-right">التعهدات</h4>

                            <h5 class="text-right">
                                إن هذا الخطاب يُمثّل كامل الإتفاقية فيما بين الشركة ومكـتب
                                {{$OfficeInfo->name}}
                                للمحاسبة. فيما يتعلق بالخدمات المشار إليها في هذا الخطاب. هذا الخطاب يلغي أية عروض أو مراسلات أو إتفاقيات تفاهم سابقة سواءً كانت خطّية أو شفهية تخص العمل موضوع هذا الخطاب. إن الإتفاقيات القائمة بين الشركة أو المكتب والمتضمنة في هذا الخطاب سوف تظل سارية حتى إكمال أو إنهاء الأمور موضوع هذا الخطاب.
                                يسري مفعول هذا الخطاب على السنوات اللاحقة ما لم تتم إجراءات تعديل خطّي على بنوده.
                            </h5>
                        </td>
                    </tr>
                    <!---/. Sixth Row ------>
                    <!---Seventh Row ------>
                    <tr>
                        <td>
                            <h4 class="text-left">Fees and Other Service</h4>
                            <h5 class=" text-left">

                                Our fees are charged on the basis of time occupied and expenses incurred having regard to the degree of responsibility involved and the experience and skill required for the audit of the financial statements. For the year ending on 31/12/2017 we estimate our fees to be SAR () include uploading Qawaem program
                            </h5>
                        </td>
                        <td>
                            <h4 class="text-right">أتعابنا المهنية</h4>

                            <h5 class="text-right">
                                إن أتعابنا المهنية تم تحديدها وفق ساعات العمل التي يتم خلالها إكمال عملية المراجعة آخذين في الإعتبار مدى المسئولية والخبرات الفنية التي تتطلبها عملية مراجعة القوائم المالية. وعليه ستكون أتعابنا المقدرة للسنة المالية المنتهية في
                                {{$Transaction->end_financial_year}}
                                مبلغ
                                ( {{$Transaction->total_value}} )
                                ريال سعودي شاملة الإيداع الالكتروني في نظام قوائم. وموزع كالآتي:
                            </h5>
                        </td>
                    </tr>
                    <!---/. Seventh Row ------>

                    <!---eighth Row ------>

                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h5 class="pull-left text-left">Audit Fees :
                            {{$Transaction->agreed_contract_value}}
                            </h5>
                        </td>
                        <td style="width: 50%;background-color: #95B3D7"><h5 class="text-right">  أتعاب المراجعة
                                :
                                {{$Transaction->agreed_contract_value}}
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h5 class="pull-left text-left">Zakat deposit fees:
                                {{$Transaction->zakat_deposit_fees}}
                            </h5>
                        </td>
                        <td style="width: 50%;background-color: #95B3D7"><h5 class="text-right">
                                 أتعاب إيداع زكاة
                                :
                                {{$Transaction->zakat_deposit_fees}}
                            </h5>
                        </td>
                    </tr>

                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h5 class="pull-left text-left">Value Added Tax :
                            {{($Transaction->value_added_tax/100) * $Transaction->agreed_contract_value}}
                            </h5>
                        </td>
                        <td style="width: 50%;background-color: #95B3D7"><h5 class="text-right"> ضرائب القيمة المضافة
                                :
                                {{($Transaction->value_added_tax/100) * $Transaction->agreed_contract_value}}
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h5 class="pull-left text-left">Value Added Tax :
                            {{$Transaction->offer_value}}
                            </h5>
                        </td>
                        <td style="width: 50%;background-color: #95B3D7"><h5 class="text-right">
                                قيمة الخصم
                                :
                                {{$Transaction->offer_value}}
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;background-color: #95B3D7 "><h5 class="pull-left text-left">Total :
                            {{$Transaction->total_value}}
                            </h5>
                        </td>
                        <td style="width: 50%;background-color: #95B3D7"><h5 class="text-right"> الإجمالي
                                :
                                {{$Transaction->total_value}}
                            </h5>

                        </td>
                    </tr>

                    <!---/. eighth Row ------>
                    <!---Ninth Row ------>
                    <tr>
                        <td>
                            <h5 class="pull-left text-left">This estimate assumes we will receive appropriate assistance from your staff in preparation of schedules and other matters, and that, this assistance According to the standards of the Saudi Organization for Certified Public Accountants (SCOPA) and the payments is on a timely basis will be as following:
                                50% when signing this proposal.
                                50% upon resaving the financial statements.
                                Any. Additional accounting services that do not form part of our audit scope will be billed separately and the fees agreed with you before commencing such work.

                            </h5>
                        </td>
                        <td>
                            <h5 class="pull-right text-right">
                                وهذه التقديرات مبنية على افتراضنا بأننا سنجد من المختصين لديكم المساعدة المناسبة في إعداد الجداول والتحاليل المطلوبة والتي تم اعتبارها ضمن الوقت المحدد لإنجاز عملية المراجعة علماً أن طريقة دفع الأتعاب ستكون وفقاً لمعايير الهيئة السعودية للمحاسبين القانونين على النحو التالي:
                                50% عند توقيع هذا العرض
                                50% عند استلام القوائم المالية
                                علماً بأن كل المصروفات التي تنفق على السفر إلى مواقعكم وفروعكم التي تتواجد في أماكن خارج الرياض ستتم إضافتها للأتعاب أعلاها وبفاتورة أو فواتير منفصلة.
                                كما أن أية خدمات إضافية تطلبونها ونستطيع تقديمها ونوافق عليها ستتم من خلال إتفاق منفصل. أية أعمال محاسبية إضافية لم يشملها هذا الإتفاق فستكون أتعابها منفصلة سيتم سداد أتعابها مقدّماً
                            </h5>

                        </td>
                    </tr>
                    <!---/. Ninth Row ------>
                    <!---tenth Row ------>
                    <tr>

                        <td>
                            <h4 class="text-left">Acknowledgement</h4>

                            <h5 class="text-left">
                                Please sign and retu
                                rn the attached copy of this letter to indicate that it is in accordance with your understanding of arrangements for our audit of the financial statements.
                                Best Regards,
                                For A-Al-Bakheet certified Public Account Certified Public Accountants Office
                                Ali Abdallah Al-Bakhee

                            </h5>
                            <h5 class="text-left" style="padding-top: 20px">


                                Signature : ........................................

                            </h5>
                            <h5 class="text-left" style="padding-top: 20px">
                                Acknowledged on behalf of the company
                            </h5>
                            <h5 class="text-left" style="padding-top: 20px">
                                Signature : ........................................

                            </h5>

                            <h5 class="text-left" style="padding-top: 20px">
                                Name : ........................................

                            </h5>

                            <h5 class="text-left" style="padding-top: 20px">
                                Date : ........................................

                            </h5>
                        </td>
                        <td>
                            <h4 class="text-right">الإستلام والموافقة</h4>

                            <h5 class="text-right">
                                نرجو التكرم بالتوقيع على هذه النسخة وإعادتها لنا للدلالة على أنها تتفق مع مفهومكم للشروط والترتيبات الخاصة بمراجعتنا للقوائم المالية.
                                ولكم خالص تحياتنا وتقديرنا،،،،،
                                عن مكتب
                                {{$OfficeInfo->name}}
                                للمحاسبة والمراجعة
                                {{$OfficeInfo->name}}
                            </h5>
                            <h5 class="text-right" style="padding-top: 20px">
                                ........................................
                                :

                                التوقيع
                            </h5>
                            <h5 class="text-right" style="padding-top: 20px">
                                نوافق على ما ورد أعلاه نيابة عن الشركة

                            </h5>
                            <h5 class="text-right" style="padding-top: 20px">

                                ........................................
                                :

                                الإسم
                            </h5>

                            <h5 class="text-right" style="padding-top: 20px">
                                ........................................
                                :

                                التوقيع
                            </h5>

                            <h5 class="text-right" style="padding-top: 20px">
                                ........................................
                                :

                                التاريخ
                            </h5>
                        </td>
                    </tr>
                    <!---/. tenth Row ------>
                    <!---- eleventh Row --->
                    <tr>
                        <td>
                            <h4 class="text-left">
                                We hope to deposit the fees or transfer them on the account of the office at Al-Rajhi Bank account number (211608010988900) or check on behalf of Ali Abdullah Al-Bakhit Al-Zahrani Office for Accounting and Auditing
                            </h4>
                        </td>
                        <td>
                            <h4 class="text-right">
                                نأمل إيداع الأتعاب أو تحويلها على حساب المكتب بمصرف
                                {{$OfficeInfo->bank_account}}
                                رقم
                                ({{$OfficeInfo->bank_account_number}})
                                أو شيك باسم مكتب
                                {{$OfficeInfo->name}}
                                للمحاسبة والمراجعة.
                            </h4>
                        </td>
                    </tr>
                    <!--- /. Eleventh Row--->
                    </tbody>
                </table>
            </div>

            <!-- /.First table -->


        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
</body>
</html>
