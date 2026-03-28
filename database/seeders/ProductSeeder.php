<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Invoice & Cash-Flow Agent',
                'slug' => 'invoice-cashflow-agent',
                'tagline' => 'Automate invoice processing and gain real-time visibility on your cash position.',
                'description' => "The Invoice & Cash-Flow Agent is built for MSMEs that still rely on manual data entry for incoming and outgoing invoices. It reads invoices from email, scans, or uploads, extracts key data using AI, matches them against purchase orders, and feeds your accounting system automatically.\n\nThe result: fewer errors, faster processing, and a live cash-flow dashboard that shows you exactly where your money is at any moment. No more end-of-month surprises.",
                'problems' => [
                    'Hours wasted every week manually entering invoice data into spreadsheets or accounting software.',
                    'Frequent errors in amounts, VAT calculations, or duplicate entries.',
                    'No real-time overview of outstanding receivables and payables.',
                    'Cash-flow surprises at the end of every month because data is always lagging.',
                ],
                'how_it_works' => [
                    'Connect your email inbox or upload invoices manually. The agent monitors for new documents continuously.',
                    'AI extracts key fields: supplier/customer, amounts, VAT, due dates, line items, and PO references.',
                    'The agent matches invoices to existing purchase orders or contracts and flags discrepancies for review.',
                    'Validated data is pushed to your accounting software (QuickBooks, Xero, or custom ERP) via API.',
                    'A live dashboard shows your cash position, aging receivables, and projected cash-flow for the next 30/60/90 days.',
                ],
                'example_workflow' => "Invoice received via email\n  → Agent extracts: Supplier=Acme GmbH, Amount=€4,200.00, VAT=€798.00, Due=2026-04-15\n  → Matched to PO #2024-0387 (amount matches within 2% tolerance)\n  → Auto-approved, pushed to Xero as draft bill\n  → Cash-flow dashboard updated: April projected outflow +€4,200\n  → Finance manager notified via Slack",
                'availability' => 'available',
                'availability_note' => null,
                'sort_order' => 1,
            ],
            [
                'name' => 'Document & Workflow Inbox',
                'slug' => 'document-workflow-inbox',
                'tagline' => 'One intelligent inbox for all your business documents — automatically classified and routed.',
                'description' => "The Document & Workflow Inbox replaces the chaos of scattered emails, shared drives, and paper documents with a single intelligent entry point. Every document that enters your business — contracts, invoices, delivery notes, compliance forms — is automatically classified, tagged, and routed to the right person or process.\n\nYour team stops wasting time searching for files or wondering who is handling what. Everything is tracked, searchable, and auditable.",
                'problems' => [
                    'Documents arrive via email, WhatsApp, post, and shared drives with no unified system.',
                    'Team members spend significant time searching for or re-requesting documents.',
                    'No visibility on whether a document has been processed, approved, or filed.',
                    'Compliance risk from lost or misfiled documents.',
                ],
                'how_it_works' => [
                    'Documents enter via email forwarding, file upload, or API integration with your existing tools.',
                    'AI classifies each document by type (invoice, contract, delivery note, etc.) and extracts metadata.',
                    'Rules-based routing sends documents to the responsible team member or triggers automated workflows.',
                    'A unified dashboard shows all documents, their status, and who is responsible at each stage.',
                    'Full-text search and audit trail for compliance and easy retrieval.',
                ],
                'example_workflow' => "Email with PDF attachment received at docs@yourcompany.eu\n  → Agent classifies: Type=Supplier Contract, Language=German\n  → Metadata extracted: Supplier=MüllerTech, Start=2026-01-01, Value=€36,000/yr\n  → Routed to: Legal review queue (auto-assigned to Maria)\n  → Maria approves → document filed in /Contracts/Suppliers/MüllerTech/\n  → Reminder set: renewal review 60 days before expiry",
                'availability' => 'available',
                'availability_note' => null,
                'sort_order' => 2,
            ],
            [
                'name' => 'Payments & Approvals Orchestrator',
                'slug' => 'payments-approvals-orchestrator',
                'tagline' => 'Streamline payment runs and multi-level approvals with configurable rules.',
                'description' => "The Payments & Approvals Orchestrator brings structure to how your business handles outgoing payments. It enforces approval workflows based on amount thresholds, department, and supplier — ensuring nothing gets paid without the right sign-off, while eliminating the bottleneck of chasing approvers via email.\n\nPayment batches are prepared automatically and can be exported to your bank or executed via API integration.",
                'problems' => [
                    'Payment approvals done via email or verbal confirmation with no audit trail.',
                    'Invoices sitting unpaid because the right approver did not see them in time.',
                    'No clear policy enforcement: different people approve different amounts inconsistently.',
                    'Manual preparation of bank payment files is slow and error-prone.',
                ],
                'how_it_works' => [
                    'Define approval rules: amount thresholds, required approvers by department or cost center.',
                    'When an invoice is ready for payment, the orchestrator routes it to the correct approval chain.',
                    'Approvers receive notifications (email, Slack, or in-app) and can approve or reject with one click.',
                    'Approved invoices are batched into payment runs on your schedule (weekly, bi-weekly, etc.).',
                    'Payment files are generated in your bank format (SEPA, SWIFT) or pushed via banking API.',
                ],
                'example_workflow' => "Invoice from CloudHost Ltd: €8,500 (IT infrastructure)\n  → Rule match: IT dept + amount > €5,000 → requires IT Manager + CFO approval\n  → IT Manager approves (via mobile notification, 2 hours after submission)\n  → CFO approves (next morning, via email link)\n  → Invoice added to Friday payment batch\n  → SEPA XML file generated → uploaded to bank portal\n  → Supplier notified: payment scheduled for Monday",
                'availability' => 'coming_soon',
                'availability_note' => 'Coming Q4 2026 – pre-register for early access',
                'sort_order' => 3,
            ],
            [
                'name' => 'Vertical Operations Cockpit',
                'slug' => 'vertical-operations-cockpit',
                'tagline' => 'A real-time operational dashboard tailored to your industry and KPIs.',
                'description' => "The Vertical Operations Cockpit gives you a single screen view of how your business is performing right now. Unlike generic dashboards, it is configured for your specific industry — whether you run a logistics company, a manufacturing workshop, or a hospitality business.\n\nIt pulls data from your existing tools (ERP, CRM, accounting, production systems) and presents the KPIs that matter most, updated in real time.",
                'problems' => [
                    'Key operational data lives in separate systems with no unified view.',
                    'Managers rely on weekly or monthly reports that are already outdated when they arrive.',
                    'No easy way to spot trends, bottlenecks, or anomalies before they become problems.',
                    'Building custom dashboards requires expensive BI tools and technical skills you do not have.',
                ],
                'how_it_works' => [
                    'We identify your top 10–15 KPIs based on your industry and business priorities.',
                    'Connectors pull data from your existing tools: ERP, CRM, accounting, spreadsheets, production systems.',
                    'A real-time dashboard is configured with the layouts and visualizations that fit your workflow.',
                    'AI-powered alerts notify you when metrics deviate from expected ranges.',
                    'Weekly auto-generated summaries are sent to your inbox with key highlights and trends.',
                ],
                'example_workflow' => "Data sources connected:\n  → ERP (orders, inventory) + Accounting (revenue, costs) + CRM (pipeline, support tickets)\n\nDashboard widgets:\n  ┌──────────────────┬──────────────────┬──────────────────┐\n  │ Revenue MTD      │ Orders in Prod.  │ Avg. Lead Time   │\n  │ €142,300 (+8%)   │ 47 active        │ 4.2 days (-0.3)  │\n  ├──────────────────┼──────────────────┼──────────────────┤\n  │ Cash Position    │ Support Tickets  │ Inventory Alert  │\n  │ €89,200          │ 12 open (3 SLA)  │ 2 items below    │\n  └──────────────────┴──────────────────┴──────────────────┘\n\nAlert: Support ticket SLA breach → auto-escalation to team lead",
                'availability' => 'coming_soon',
                'availability_note' => 'Coming Q1 2027 – pre-register for early access',
                'sort_order' => 4,
            ],
            [
                'name' => 'Copilot on Operating Data',
                'slug' => 'copilot-operating-data',
                'tagline' => 'Ask questions about your business data in plain language and get instant answers.',
                'description' => "The Copilot on Operating Data is a conversational AI layer on top of your business systems. Instead of digging through reports or asking your accountant, you can ask questions like \"What were our top 5 customers by revenue last quarter?\" or \"How many invoices are overdue by more than 30 days?\" and get accurate answers in seconds.\n\nIt connects to the same data sources as the Operations Cockpit and adds a natural-language query interface that anyone on your team can use.",
                'problems' => [
                    'Getting answers from your data requires building reports or asking someone technical.',
                    'Ad-hoc questions take hours or days to answer because the data lives in separate systems.',
                    'Management decisions are delayed because the information is not readily accessible.',
                    'Only one or two people in the company know how to query the data effectively.',
                ],
                'how_it_works' => [
                    'The Copilot connects to your data sources (same connectors as the Operations Cockpit).',
                    'A secure index is built over your operational data, respecting access permissions.',
                    'Team members ask questions in plain English (or French, German, Italian, Spanish, Dutch).',
                    'The AI translates questions into data queries, runs them, and returns clear answers with context.',
                    'Results can be exported as tables, charts, or shared via email/Slack.',
                ],
                'example_workflow' => "User asks: \"What were our top 5 suppliers by spend in Q1 2026?\"\n\n  → Copilot queries: accounting system → purchase ledger → Q1 2026 filter\n  → Response:\n\n    1. MüllerTech GmbH        €42,100\n    2. CloudHost Ltd           €28,500\n    3. Bureau Express SAS      €19,300\n    4. Nordic Supplies AB      €15,800\n    5. Adriatica Packaging     €12,200\n\n    Total top-5 spend: €117,900 (68% of total Q1 supplier spend)\n\n  → User: \"Show me the trend vs Q4 2025\"\n  → Copilot generates comparison table with delta percentages",
                'availability' => 'coming_soon',
                'availability_note' => 'Coming Q2 2027 – pre-register for early access',
                'sort_order' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
