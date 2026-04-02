@extends('layouts.app')

@section('title', 'AI Readiness Assessment — Corvalys')
@section('meta_description', 'Evaluate your organisation\'s AI readiness across 6 key dimensions. Get personalised insights and recommendations for your AI journey.')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
@endpush

@section('content')

{{-- ══════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════ --}}
<section class="bg-hero relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none select-none" aria-hidden="true">
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-primary/20 blur-[120px] opacity-60"></div>
        <div class="absolute top-1/2 right-0 translate-x-1/3 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-navy-light/30 blur-[100px] opacity-50"></div>
        <div class="absolute inset-0 opacity-[0.04]"
             style="background-image: linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:64px 64px;"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 pt-36 pb-16 lg:pt-44 lg:pb-20 text-center">
        <span class="inline-block mb-6 badge bg-primary/20 text-primary-light border border-primary/30 text-xs font-semibold tracking-widest uppercase backdrop-blur-sm px-4 py-1.5 rounded-full"
              data-i18n="survey.hero.badge">
            Free Assessment
        </span>
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-[1.08] mb-6"
            data-i18n="survey.hero.title">
            AI Readiness Assessment
        </h1>
        <p class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
           data-i18n="survey.hero.sub">
            Evaluate your organisation across 6 key dimensions and discover where you stand on the AI adoption journey.
        </p>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     SURVEY FORM
══════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 lg:py-24" x-data="surveyApp()" x-cloak>
    <div class="max-w-4xl mx-auto px-6">

        {{-- ── Results (shown after submit) ── --}}
        <template x-if="submitted && results">
            <div>
                @include('pages.survey._results')
            </div>
        </template>

        {{-- ── Form (hidden after submit) ── --}}
        <template x-if="!submitted">
            <div>
                {{-- Progress bar --}}
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500 font-body" data-i18n="survey.progress">
                            Step <span x-text="step"></span> of <span x-text="totalSteps"></span>
                        </span>
                        <span class="text-sm font-semibold text-primary font-body"
                              x-text="Math.round((step / totalSteps) * 100) + '%'"></span>
                    </div>
                    <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-primary rounded-full transition-all duration-500 ease-out"
                             :style="'width:' + ((step / totalSteps) * 100) + '%'"></div>
                    </div>
                </div>

                <form @submit.prevent="submitSurvey()" novalidate>
                    @csrf

                    {{-- ════════════ STEP 1: Company Information ════════════ --}}
                    <div x-show="step === 1"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 lg:p-10">
                            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-[#1B3A5C] mb-2"
                                data-i18n="survey.step1.title">
                                Company Information
                            </h2>
                            <p class="text-gray-500 mb-8 font-body" data-i18n="survey.step1.desc">
                                Tell us about your organisation so we can tailor the assessment.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Company Name --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.company_name">Company Name *</label>
                                    <input type="text" x-model="company_name"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           :class="errors.company_name ? 'border-red-400' : ''"
                                           placeholder="Acme Corp">
                                    <p x-show="errors.company_name" x-text="errors.company_name" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Company Size --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.company_size">Company Size *</label>
                                    <select x-model="company_size"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body bg-white"
                                            :class="errors.company_size ? 'border-red-400' : ''">
                                        <option value="">Select size...</option>
                                        <option value="1-9">1-9 employees</option>
                                        <option value="10-49">10-49 employees</option>
                                        <option value="50-249">50-249 employees</option>
                                        <option value="250+">250+ employees</option>
                                    </select>
                                    <p x-show="errors.company_size" x-text="errors.company_size" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Industry --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.industry">Industry *</label>
                                    <select x-model="industry"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body bg-white"
                                            :class="errors.industry ? 'border-red-400' : ''">
                                        <option value="">Select industry...</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Financial Services">Financial Services</option>
                                        <option value="Professional Services">Professional Services</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Construction">Construction</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Education">Education</option>
                                        <option value="Hospitality">Hospitality</option>
                                        <option value="Transportation">Transportation</option>
                                        <option value="Energy">Energy</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <p x-show="errors.industry" x-text="errors.industry" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Country --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.country">Country</label>
                                    <input type="text" x-model="country"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           placeholder="Italy">
                                </div>

                                {{-- Contact Name --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.contact_name">Contact Name *</label>
                                    <input type="text" x-model="contact_name"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           :class="errors.contact_name ? 'border-red-400' : ''"
                                           placeholder="Maria Rossi">
                                    <p x-show="errors.contact_name" x-text="errors.contact_name" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Contact Email --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.contact_email">Contact Email *</label>
                                    <input type="email" x-model="contact_email"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           :class="errors.contact_email ? 'border-red-400' : ''"
                                           placeholder="maria@acme.com">
                                    <p x-show="errors.contact_email" x-text="errors.contact_email" class="text-red-500 text-xs mt-1"></p>
                                </div>

                                {{-- Contact Role --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.contact_role">Role / Title</label>
                                    <input type="text" x-model="contact_role"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           placeholder="Operations Manager">
                                </div>

                                {{-- Contact Phone --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.contact_phone">Phone</label>
                                    <input type="tel" x-model="contact_phone"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                           placeholder="+39 02 1234567">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ════════════ STEP 2: Leadership & Strategy ════════════ --}}
                    <div x-show="step === 2"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'leadership',
                            'stepNum' => 2,
                            'title' => 'Leadership & Strategy',
                            'description' => 'Assess your organisation\'s leadership commitment to AI adoption and strategic alignment.',
                            'criteria' => [
                                ['code' => 'L1', 'name' => 'AI Vision', 'desc' => 'Leadership has articulated a clear vision for how AI could benefit the organisation'],
                                ['code' => 'L2', 'name' => 'Executive Sponsorship', 'desc' => 'A senior leader actively champions AI adoption and commits personal attention'],
                                ['code' => 'L3', 'name' => 'Strategic Alignment', 'desc' => 'AI initiatives are clearly linked to documented business strategy and objectives'],
                                ['code' => 'L4', 'name' => 'Investment Commitment', 'desc' => 'Leadership is willing to allocate budget and resources to AI exploration'],
                                ['code' => 'L5', 'name' => 'Risk Tolerance', 'desc' => 'Leadership demonstrates appropriate risk tolerance for innovation and technology adoption'],
                                ['code' => 'L6', 'name' => 'Change Leadership', 'desc' => 'Leaders actively model and support organisational change and digital transformation'],
                                ['code' => 'L7', 'name' => 'Industry Awareness', 'desc' => 'Leadership understands AI applications relevant to their industry sector'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'No awareness of AI; no strategic conversation; technology seen as cost center only'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Heard of AI but no plans; not in strategy; budget allocation unlikely'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Interested in AI; some informal conversations; willing to explore but cautious'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'Actively seeks AI opportunities; AI in strategic plans; budget discussed; champion identified'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'AI is strategic priority; dedicated budget; champion engaged; clear vision; competitive landscape understood'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 3: Data Foundations ════════════ --}}
                    <div x-show="step === 3"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'data',
                            'stepNum' => 3,
                            'title' => 'Data Foundations',
                            'description' => 'Evaluate the state of your data assets, quality, governance, and accessibility.',
                            'criteria' => [
                                ['code' => 'D1', 'name' => 'Data Availability', 'desc' => 'Relevant business data is collected and stored in accessible formats'],
                                ['code' => 'D2', 'name' => 'Data Quality', 'desc' => 'Data is accurate, complete, consistent, and timely'],
                                ['code' => 'D3', 'name' => 'Data Accessibility', 'desc' => 'Data can be extracted, combined, and used across systems without excessive manual effort'],
                                ['code' => 'D4', 'name' => 'Data Volume', 'desc' => 'Sufficient historical data exists to support AI model training'],
                                ['code' => 'D5', 'name' => 'Data Variety', 'desc' => 'Multiple relevant data types are available (structured, semi-structured, text, images)'],
                                ['code' => 'D6', 'name' => 'Data Governance', 'desc' => 'Formal or informal rules exist for data ownership, quality, and lifecycle management'],
                                ['code' => 'D7', 'name' => 'Data Cataloguing', 'desc' => 'The organisation knows what data it has, where it is stored, and who owns it'],
                                ['code' => 'D8', 'name' => 'Data Security', 'desc' => 'Data is protected with appropriate access controls, encryption, and backup'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'Scattered, undocumented, mostly spreadsheets/paper; no governance'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Some digitised but in silos; inconsistent quality; manual extraction'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Core data in systems (ERP/CRM); basic quality; some exports; moderate history'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'Well-organised integrated systems; quality monitoring; programmatic access; good history'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'Comprehensive catalogue; formal governance; automated monitoring; APIs; data warehouse'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 4: Technology Infrastructure ════════════ --}}
                    <div x-show="step === 4"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'technology',
                            'stepNum' => 4,
                            'title' => 'Technology Infrastructure',
                            'description' => 'Assess your technology stack, cloud readiness, and integration capabilities.',
                            'criteria' => [
                                ['code' => 'T1', 'name' => 'Core Systems', 'desc' => 'Modern, supported business systems (ERP, CRM) in place'],
                                ['code' => 'T2', 'name' => 'Cloud Readiness', 'desc' => 'Uses or prepared to use cloud infrastructure'],
                                ['code' => 'T3', 'name' => 'Integration Capability', 'desc' => 'Systems can exchange data through APIs, ETL, or integration platforms'],
                                ['code' => 'T4', 'name' => 'Computational Resources', 'desc' => 'Adequate processing power for AI workloads (or cloud access)'],
                                ['code' => 'T5', 'name' => 'Network Infrastructure', 'desc' => 'Reliable, sufficient-bandwidth connectivity'],
                                ['code' => 'T6', 'name' => 'Security Posture', 'desc' => 'Cybersecurity measures appropriate for AI systems and sensitive data'],
                                ['code' => 'T7', 'name' => 'IT Support Capability', 'desc' => 'Internal or external IT support can maintain AI-related infrastructure'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'Outdated/no systems; no cloud; no integration; basic internet; minimal security'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Basic systems; email in cloud; no integration; limited connectivity; ad-hoc IT'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Core systems in place; basic cloud usage; limited integration; adequate connectivity; external IT'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'Modern integrated systems; significant cloud; APIs available; good connectivity; responsive IT'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'Fully modern stack; cloud-native; comprehensive APIs; high-bandwidth; dedicated IT support'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 5: Culture & Skills ════════════ --}}
                    <div x-show="step === 5"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'culture',
                            'stepNum' => 5,
                            'title' => 'Culture & Skills',
                            'description' => 'Evaluate your team\'s digital literacy, AI awareness, and readiness for change.',
                            'criteria' => [
                                ['code' => 'C1', 'name' => 'Digital Literacy', 'desc' => 'Staff comfortable using digital tools daily'],
                                ['code' => 'C2', 'name' => 'Change Readiness', 'desc' => 'Track record of successfully adopting new technologies'],
                                ['code' => 'C3', 'name' => 'AI Awareness', 'desc' => 'Staff have basic awareness of AI and its potential impact'],
                                ['code' => 'C4', 'name' => 'Data Literacy', 'desc' => 'Key staff understand data concepts and can interpret insights'],
                                ['code' => 'C5', 'name' => 'Learning Culture', 'desc' => 'Organisation invests in training and encourages continuous learning'],
                                ['code' => 'C6', 'name' => 'Innovation Mindset', 'desc' => 'Organisation welcomes experimentation and tolerates failure'],
                                ['code' => 'C7', 'name' => 'Collaboration', 'desc' => 'Cross-functional collaboration is common and effective'],
                                ['code' => 'C8', 'name' => 'AI/Data Skills', 'desc' => 'Staff with data analysis, statistics, or AI-related skills'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'Low digital literacy; resistance to change; no AI awareness; fear of technology'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Basic digital skills; past changes difficult; AI is buzzword; limited training'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Staff competent with systems; growing AI curiosity; some data-savvy individuals; occasional training'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'High digital comfort; positive change track record; curious about AI; regular training'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'Tech-savvy workforce; embrace change; AI understood broadly; continuous learning embedded'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 6: Process Maturity ════════════ --}}
                    <div x-show="step === 6"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'process',
                            'stepNum' => 6,
                            'title' => 'Process Maturity',
                            'description' => 'Assess how well your business processes are documented, standardised, and automated.',
                            'criteria' => [
                                ['code' => 'P1', 'name' => 'Process Documentation', 'desc' => 'Key processes documented with clear steps and responsibilities'],
                                ['code' => 'P2', 'name' => 'Process Standardisation', 'desc' => 'Processes executed consistently across the organisation'],
                                ['code' => 'P3', 'name' => 'Process Measurement', 'desc' => 'Key processes have defined KPIs regularly tracked'],
                                ['code' => 'P4', 'name' => 'Process Automation', 'desc' => 'Some processes already automated (macros, workflows)'],
                                ['code' => 'P5', 'name' => 'Process Optimisation', 'desc' => 'Organisation regularly reviews and improves processes'],
                                ['code' => 'P6', 'name' => 'Process Ownership', 'desc' => 'Each key process has a designated owner'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'No documentation; varies by person; no metrics; no automation; processes just "happen"'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Some informal docs; somewhat consistent; basic metrics; no systematic automation'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Core processes documented; reasonable consistency; operational KPIs; some basic automation'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'Comprehensive documentation; standardised execution; robust KPIs; meaningful automation'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'Full process library; high standardisation; real-time dashboards; extensive automation'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 7: Compliance & Governance ════════════ --}}
                    <div x-show="step === 7"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        @include('pages.survey._dimension', [
                            'dimKey' => 'compliance',
                            'stepNum' => 7,
                            'title' => 'Compliance & Governance',
                            'description' => 'Evaluate your regulatory awareness, data protection practices, and governance maturity.',
                            'criteria' => [
                                ['code' => 'G1', 'name' => 'GDPR Awareness', 'desc' => 'Understands GDPR requirements relevant to data processing'],
                                ['code' => 'G2', 'name' => 'Data Protection Practices', 'desc' => 'Appropriate measures in place (consent, access controls, retention)'],
                                ['code' => 'G3', 'name' => 'Privacy Policies', 'desc' => 'Documented and published privacy policies'],
                                ['code' => 'G4', 'name' => 'EU AI Act Awareness', 'desc' => 'Awareness of EU AI Act and its potential implications'],
                                ['code' => 'G5', 'name' => 'Governance Framework', 'desc' => 'Formal or informal governance structures for technology decisions'],
                                ['code' => 'G6', 'name' => 'Risk Management Practices', 'desc' => 'Some form of risk identification and management'],
                                ['code' => 'G7', 'name' => 'Regulatory Monitoring', 'desc' => 'Monitors regulatory changes relevant to its sector'],
                            ],
                            'guide' => [
                                ['score' => 1, 'label' => 'Very Low', 'desc' => 'No GDPR awareness; no data protection; no privacy policies; no AI Act awareness; no governance'],
                                ['score' => 2, 'label' => 'Low', 'desc' => 'Heard of GDPR but non-compliant; minimal protection; generic privacy policy; ad-hoc governance'],
                                ['score' => 3, 'label' => 'Moderate', 'desc' => 'Basic GDPR compliance; measures in place; privacy policy exists; limited AI Act awareness'],
                                ['score' => 4, 'label' => 'Good', 'desc' => 'Good GDPR compliance; comprehensive protection; reviewed policies; some AI Act understanding'],
                                ['score' => 5, 'label' => 'Excellent', 'desc' => 'Full compliance with DPO; mature protection; comprehensive policies; AI Act preparation; formal governance'],
                            ],
                        ])
                    </div>

                    {{-- ════════════ STEP 8: Review & Submit ════════════ --}}
                    <div x-show="step === 8"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 lg:p-10">
                            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-[#1B3A5C] mb-2"
                                data-i18n="survey.step8.title">
                                Review & Submit
                            </h2>
                            <p class="text-gray-500 mb-8 font-body" data-i18n="survey.step8.desc">
                                Review your dimension scores and submit your assessment.
                            </p>

                            {{-- Dimension summary bars --}}
                            <div class="space-y-4 mb-8">
                                <template x-for="dim in dimensionList" :key="dim.key">
                                    <div>
                                        <div class="flex items-center justify-between mb-1.5">
                                            <span class="text-sm font-semibold text-gray-700 font-body" x-text="dim.label"></span>
                                            <span class="text-sm font-bold font-body"
                                                  :class="dimAvg(dim.key) >= 4 ? 'text-green-600' : (dimAvg(dim.key) >= 3 ? 'text-amber-600' : (dimAvg(dim.key) > 0 ? 'text-red-500' : 'text-gray-400'))"
                                                  x-text="dimAvg(dim.key) > 0 ? dimAvg(dim.key).toFixed(1) + ' / 5.0' : 'Not scored'"></span>
                                        </div>
                                        <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-700 ease-out"
                                                 :class="dimAvg(dim.key) >= 4 ? 'bg-green-500' : (dimAvg(dim.key) >= 3 ? 'bg-amber-500' : 'bg-red-400')"
                                                 :style="'width:' + ((dimAvg(dim.key) / 5) * 100) + '%'"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Overall average --}}
                            <div class="bg-gray-50 rounded-xl p-6 mb-8 text-center">
                                <p class="text-sm font-semibold text-gray-500 mb-1 font-body" data-i18n="survey.overall">Overall Readiness Score</p>
                                <p class="text-5xl font-heading font-bold"
                                   :class="overallAvg() >= 4 ? 'text-green-600' : (overallAvg() >= 3 ? 'text-amber-600' : (overallAvg() > 0 ? 'text-red-500' : 'text-gray-400'))"
                                   x-text="overallAvg() > 0 ? overallAvg().toFixed(1) : '--'"></p>
                                <p class="text-sm text-gray-500 mt-1 font-body" x-text="readinessLabel(overallAvg())"></p>
                            </div>

                            {{-- Additional comments --}}
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5 font-body" data-i18n="survey.field.comments">Additional Comments</label>
                                <textarea x-model="additional_comments" rows="4"
                                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors font-body"
                                          placeholder="Any additional context about your organisation's AI readiness..."></textarea>
                            </div>

                            {{-- Consultation checkbox --}}
                            <label class="flex items-start gap-3 mb-8 cursor-pointer group">
                                <input type="checkbox" x-model="wants_consultation"
                                       class="mt-0.5 w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/30">
                                <span class="text-sm text-gray-600 font-body group-hover:text-gray-800 transition-colors"
                                      data-i18n="survey.field.consultation">
                                    I'd like a free consultation to discuss my results and get personalised recommendations.
                                </span>
                            </label>

                            {{-- Error message --}}
                            <div x-show="Object.keys(errors).length > 0" class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                                <p class="text-sm text-red-600 font-semibold font-body" data-i18n="survey.errors">Please fix the following errors:</p>
                                <ul class="mt-1 text-sm text-red-500">
                                    <template x-for="(msg, key) in errors" :key="key">
                                        <li x-text="msg" class="ml-4 list-disc"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- ── Navigation Buttons ── --}}
                    <div class="flex items-center justify-between mt-8">
                        <button type="button"
                                x-show="step > 1"
                                @click="prevStep()"
                                class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 font-body">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            <span data-i18n="survey.btn.prev">Previous</span>
                        </button>
                        <div x-show="step === 1"></div>

                        <button type="button"
                                x-show="step < totalSteps"
                                @click="nextStep()"
                                class="flex items-center gap-2 px-8 py-3 bg-[#0F7B6C] text-white rounded-xl font-semibold text-sm hover:bg-[#0d6b5e] hover:shadow-lg hover:shadow-primary/20 transition-all duration-200 font-body ml-auto">
                            <span data-i18n="survey.btn.next">Next Step</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </button>

                        <button type="submit"
                                x-show="step === totalSteps"
                                :disabled="submitting"
                                class="flex items-center gap-2 px-8 py-3 bg-[#0F7B6C] text-white rounded-xl font-semibold text-sm hover:bg-[#0d6b5e] hover:shadow-lg hover:shadow-primary/20 transition-all duration-200 font-body ml-auto disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg x-show="submitting" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <span x-text="submitting ? 'Submitting...' : 'Submit Assessment'" data-i18n="survey.btn.submit"></span>
                            <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </template>
    </div>
</section>

@endsection

@push('scripts')
<script>
function surveyApp() {
    return {
        step: 1,
        totalSteps: 8,
        submitting: false,
        submitted: false,
        results: null,
        errors: {},

        // Company info
        company_name: '',
        company_size: '',
        industry: '',
        country: '',
        contact_name: '',
        contact_email: '',
        contact_role: '',
        contact_phone: '',

        // Scores
        scores: {
            leadership: { L1: 0, L2: 0, L3: 0, L4: 0, L5: 0, L6: 0, L7: 0 },
            data:       { D1: 0, D2: 0, D3: 0, D4: 0, D5: 0, D6: 0, D7: 0, D8: 0 },
            technology: { T1: 0, T2: 0, T3: 0, T4: 0, T5: 0, T6: 0, T7: 0 },
            culture:    { C1: 0, C2: 0, C3: 0, C4: 0, C5: 0, C6: 0, C7: 0, C8: 0 },
            process:    { P1: 0, P2: 0, P3: 0, P4: 0, P5: 0, P6: 0 },
            compliance: { G1: 0, G2: 0, G3: 0, G4: 0, G5: 0, G6: 0, G7: 0 },
        },

        // Notes
        notes: {
            leadership: {}, data: {}, technology: {}, culture: {}, process: {}, compliance: {}
        },

        // Low score reasons
        lowReasons: {
            leadership: {}, data: {}, technology: {}, culture: {}, process: {}, compliance: {}
        },

        additional_comments: '',
        wants_consultation: false,

        // Dimension metadata
        dimensionList: [
            { key: 'leadership', label: 'Leadership & Strategy' },
            { key: 'data', label: 'Data Foundations' },
            { key: 'technology', label: 'Technology Infrastructure' },
            { key: 'culture', label: 'Culture & Skills' },
            { key: 'process', label: 'Process Maturity' },
            { key: 'compliance', label: 'Compliance & Governance' },
        ],

        // Compute average for a dimension (exclude 0s)
        dimAvg(dim) {
            const vals = Object.values(this.scores[dim]).filter(v => v > 0);
            if (vals.length === 0) return 0;
            return vals.reduce((a, b) => a + b, 0) / vals.length;
        },

        // Overall average across all dimensions with scores
        overallAvg() {
            const avgs = this.dimensionList
                .map(d => this.dimAvg(d.key))
                .filter(v => v > 0);
            if (avgs.length === 0) return 0;
            return avgs.reduce((a, b) => a + b, 0) / avgs.length;
        },

        // Readiness label
        readinessLabel(score) {
            if (score === 0) return '';
            if (score < 1.5) return 'Not Ready';
            if (score < 2.5) return 'Early Stage';
            if (score < 3.5) return 'Developing';
            if (score < 4.5) return 'Advanced';
            return 'AI Ready';
        },

        // Score color class
        scoreColor(val) {
            const colors = { 1: 'bg-red-500 border-red-500', 2: 'bg-orange-500 border-orange-500', 3: 'bg-amber-500 border-amber-500', 4: 'bg-blue-500 border-blue-500', 5: 'bg-green-500 border-green-500' };
            return colors[val] || '';
        },

        // Validate current step
        canProceed() {
            this.errors = {};

            if (this.step === 1) {
                if (!this.company_name.trim()) this.errors.company_name = 'Company name is required';
                if (!this.company_size) this.errors.company_size = 'Please select company size';
                if (!this.industry) this.errors.industry = 'Please select an industry';
                if (!this.contact_name.trim()) this.errors.contact_name = 'Contact name is required';
                if (!this.contact_email.trim()) {
                    this.errors.contact_email = 'Email is required';
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.contact_email)) {
                    this.errors.contact_email = 'Please enter a valid email';
                }
            }

            // For dimension steps (2-7), check at least some scores are filled
            if (this.step >= 2 && this.step <= 7) {
                const dimKeys = ['leadership', 'data', 'technology', 'culture', 'process', 'compliance'];
                const dim = dimKeys[this.step - 2];
                const vals = Object.values(this.scores[dim]);
                const scored = vals.filter(v => v > 0).length;
                if (scored === 0) {
                    this.errors.dimension = 'Please score at least one criterion before proceeding';
                }
            }

            return Object.keys(this.errors).length === 0;
        },

        nextStep() {
            if (this.canProceed()) {
                this.step++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        },

        prevStep() {
            this.errors = {};
            this.step--;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        async submitSurvey() {
            if (!this.canProceed()) return;

            this.submitting = true;
            this.errors = {};

            const payload = {
                company_name: this.company_name,
                company_size: this.company_size,
                industry: this.industry,
                country: this.country,
                contact_name: this.contact_name,
                contact_email: this.contact_email,
                contact_role: this.contact_role,
                contact_phone: this.contact_phone,
                scores: this.scores,
                notes: this.notes,
                low_reasons: this.lowReasons,
                additional_comments: this.additional_comments,
                wants_consultation: this.wants_consultation,
            };

            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const res = await fetch('/ai-readiness', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                if (!res.ok) {
                    const data = await res.json();
                    if (data.errors) {
                        this.errors = data.errors;
                    } else {
                        this.errors = { server: data.message || 'An error occurred. Please try again.' };
                    }
                    this.submitting = false;
                    return;
                }

                const data = await res.json();
                this.results = {
                    scores: {},
                    overall: this.overallAvg(),
                    label: this.readinessLabel(this.overallAvg()),
                    serverData: data,
                };

                this.dimensionList.forEach(d => {
                    this.results.scores[d.key] = {
                        label: d.label,
                        avg: this.dimAvg(d.key),
                    };
                });

                this.submitted = true;
                this.submitting = false;
                window.scrollTo({ top: 0, behavior: 'smooth' });

                // Render radar chart after DOM update
                this.$nextTick(() => { this.renderRadarChart(); });
            } catch (e) {
                this.errors = { server: 'Network error. Please check your connection and try again.' };
                this.submitting = false;
            }
        },

        renderRadarChart() {
            const canvas = document.getElementById('radarChart');
            if (!canvas) return;

            const labels = this.dimensionList.map(d => d.label);
            const data = this.dimensionList.map(d => this.dimAvg(d.key));

            new Chart(canvas, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Your Score',
                        data: data,
                        fill: true,
                        backgroundColor: 'rgba(15, 123, 108, 0.15)',
                        borderColor: '#0F7B6C',
                        borderWidth: 2,
                        pointBackgroundColor: '#0F7B6C',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 5,
                            min: 0,
                            ticks: {
                                stepSize: 1,
                                font: { size: 11 },
                                backdropColor: 'transparent',
                            },
                            pointLabels: {
                                font: { size: 12, family: 'Inter', weight: '600' },
                                color: '#374151',
                            },
                            grid: { color: 'rgba(0,0,0,0.06)' },
                            angleLines: { color: 'rgba(0,0,0,0.06)' },
                        }
                    },
                    plugins: {
                        legend: { display: false },
                    }
                }
            });
        },
    };
}
</script>
@endpush
