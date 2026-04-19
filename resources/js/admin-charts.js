/**
 * Chart.js bundle for admin analytics pages.
 *
 * Loaded via @vite('resources/js/admin-charts.js') on:
 *   - admin/survey/analytics
 *   - admin/business-survey/analytics
 *   - pages/survey (results chart)
 *
 * Keeping chart.js out of the main app bundle avoids shipping ~100 KB to
 * every public visitor when only the admin team needs it.
 */
import Chart from 'chart.js/auto';

window.Chart = Chart;
