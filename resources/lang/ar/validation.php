<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'name' => [
            'required' => 'حقل الاسم مطلوب',
            'min' => 'حروف :min يجب ان يكون الاسم على الاقل',
            'unique' => 'هذا الاسم موجود بالفعل',
        ],
        'value' => [
            'required' => 'الرجاء ادخال قيمة في هذا الحقل',
            'min' => 'حروف :min يجب ان يكون القيمة على الاقل',
        ],
        'full_name' => [
            'required' => 'حقل الاسم مطلوب',
            'min' => 'حرف :min يجب ان يكون الاسم على الاقل',
            'string' => 'يجب ان يكون الاسم نصا',
            'max' => 'حرف :max يجب ان لا يزيد الاسم عن '
        ],
        'image' => [
            'required' => 'حقل الصورة مطلوب',
            'image' => 'يجب ان يكون الملف المرفوع صورة',
            'max' => 'كيلوبايت :max يجب ان يكون حجم الصورة لا يزيد عن ',
        ],
        'main_image' => [
            'required' => 'حقل الصورة مطلوب',
            'image' => 'يجب ان يكون الملف المرفوع صورة',
            'max' => 'كيلوبايت :max يجب ان يكون حجم الصورة لا يزيد عن ',
        ],
        'email' => [
            'required' => 'حقل البريد الالكتروني مطلوب',
            'email' => 'الرجاء كتابة البريد الالكتروني بشكل صحيح',
            'unique' => 'هذا البريد موجود بالفعل',
        ],
        'password' => [
            'required' => 'حقل كلمة المرور مطلوب',
            'min' => 'حرف :min يجب ان يكون كلمة المرور على الاقل',
            'string' => 'يجب ان يكون كلمة المرور نصا',
            'max' => 'حرف :max يجب ان لا يزيد كلمة المرور عن ',
            'confirmed' => 'الرجاء تأكيد كلمة المرور بشكل صحيح',
        ],
        'new_password' => [
            'required' => 'حقل كلمة المرور الجديدة مطلوب',
            'min' => 'حرف :min يجب ان يكون كلمة المرور الجديدة على الاقل',
            'string' => 'يجب ان يكون كلمة المرور الجديدة نصا',
            'max' => 'حرف :max يجب ان لا يزيد كلمة المرور الجديدة عن ',
            'confirmed' => 'الرجاء تأكيد كلمة المرور الجديدة بشكل صحيح',
        ],
        'old_password' => [
            'required' => 'حقل كلمة المرور مطلوب',
            'string' => 'يجب ان يكون كلمة المرور نصا',
        ],
        'account_type' => [
            'required' => 'حقل  نوع الحساب مطلوب',
            'numeric' => 'يجب ان يكون نوع الحساب رقم',
        ],
        'tax_record' => [
            'required' => 'حقل  السجل الضريبي مطلوب',
            'string' => 'يجب ان يكون السجل الضريبي نصا',
            'unique' => 'هذا السجل الضريبي موجود بالفعل',
        ],
        'address' => [
            'required' => 'حقل العنوان مطلوب',
            'min' => 'حرف :min يجب ان يكون العنوان  على الاقل',
            'string' => 'يجب ان يكون العنوان  نصا',
            'max' => 'حرف :max يجب ان لا يزيد العنوان عن ',
        ],
        'about' => [
            'required' => 'حقل معلومات عن الشركة مطلوب',
            'string' => 'يجب ان يكون معلومات عن الشركة  نصا',
        ],
        'phone' => [
            'required' => 'حقل الجوال  مطلوب',
            'string' => 'يجب ان يكون جوال نصا',
        ],
        'city_id' => [
            'required' => 'حقل المدينة مطلوب',
            'numeric' => 'يجب ان يكون حقل المدينة  رقم',
            'exists' => 'الرجاء اختيار المدينة بشكل صحيح'
        ],
        'category_id' => [
            'required' => 'حقل التصنيف مطلوب',
            'numeric' => 'يجب ان يكون حقل التصنيف  رقم',
            'exists' => 'الرجاء اختيار التصنيف بشكل صحيح'
        ],
        'opened_time' => [
            'required' => 'حقل وقت فتح الشركة مطلوب',
            'string' => 'يجب ان يكون وقت فتح الشركة نصا',
        ],
        'closed_time' => [
            'required' => 'حقل وقت غلق الشركة مطلوب',
            'string' => 'يجب ان يكون وقت غلق الشركة نصا',
        ],
        'closed_days' => [
            'array' => 'يجب ان تكون ايام الاغلاق مجموعة من الايام',
            'in' => 'الرجاء اختيار ايام الاغلاق بشكل صحيح'
        ],
        'rating' => [
            'required' => 'حقل التقييم مطلوب',
            'numeric' => 'يجب ان يكون  التقييم رقم',
            'min' => 'يجب ان لا يقل التقييم عن  صفر',
            'max' => 'يجب ان لا يزيد التقييم عن  خمسة',
        ],
        'content' => [
            'required' => 'حقل المحتوى مطلوب',
            'min' => 'حرف :min يجب ان تكون المحتوى  على الاقل',
            'string' => 'يجب ان تكون المحتوى  نصا',
            'max' => 'حرف :max يجب ان لا يزيد المحتوى عن ',
        ],
        'title' => [
            'required' => 'حقل العنوان مطلوب',
            'min' => 'حرف :min يجب ان تكون العنوان  على الاقل',
            'string' => 'يجب ان تكون العنوان  نصا',
            'max' => 'حرف :max يجب ان لا يزيد العنوان عن ',
        ],
        'discoutn' => [
            'required' => 'حقل الخصم مطلوب',
            'min' => 'حرف :min يجب ان تكون الخصم  على الاقل',
            'string' => 'يجب ان تكون الخصم  نصا',
            'max' => 'حرف :max يجب ان لا يزيد الخصم عن ',
        ],
        'starting_date' => [
            'required' => 'الرجاء ادخال تاريخ بداية الخصم',
            'date' => 'الرجاى ادخال تاربخ البداية بشكل صحيح',
            'after_or_equal' => 'يجب ان يكون يبتدى الخصم على الاقل من اليوم',
        ],
        'end_date' => [
            'required' => 'الرجاء ادخال تاريخ نهاية الخصم',
            'date' => 'الرجاى ادخال تاربخ النهاية بشكل صحيح',
            'after' => 'يجب ان يكون ينتهي  الخصم على الاقل  بعد تاريخ البداية',
        ],
        'website' => [
            'url' => 'الرجاء كتابة لينك الموقع بشكل صحيح'
        ],
        'facebook' => [
            'url' => 'الرجاء كتابة لينك صفحة الفيس بوك بشكل صحيح'
        ],
        'twitter' => [
            'url' => 'الرجاء كتابة لينك صفحة تويتر بشكل صحيح'
        ],
        'youtube' => [
            'url' => 'الرجاء كتابة لينك قناة اليوتيوب بشكل صحيح'
        ],
        'instagram' => [
            'url' => 'الرجاء كتابة لينك صفحة انستجرام بشكل صحيح'
        ],
        'file.*' => [
            'required' => 'حقل الملف مطلوب',
            'image' => 'يجب ان يكون الملف المرفوع صورة',
            'max' => 'كيلوبايت :max يجب ان يكون حجم الملف لا يزيد عن ',
        ],
        'file' => [
            'required' => 'حقل الملف مطلوب',
            'image' => 'يجب ان يكون الملف المرفوع صورة',
            'max' => 'كيلوبايت :max يجب ان يكون حجم الملف لا يزيد عن ',
            'mimes' => ' mp4,webm,mpeg  يجب ان يكون ملف الفيديو المرفوع احد الصيغ '
        ],
        'quantity' => [
            'required' => 'حقل العدد مطلوب',
            'numeric' => 'يجب ان يكون  العدد رقم',
            'min' => 'يجب ان لا يقل العدد عن  واحد',
        ],
        'work_category_id' => [
            'required' => 'حقل التصنيف مطلوب',
            'in' => 'الرجاى اختيار التصنيف بشكل صحيح'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];