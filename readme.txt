=== School price calculator ===
Contributors: (this should be a list of wordpress.org userid's)
Tags: calculator
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin for the calculation of education price in the school

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the /wp-content/plugins/school-price-calculator directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the ‘Plugins’ screen in WordPress
3. Use the Settings → School price calculator screen to configure the plugin

The plugin can use options from the current or from the remote site.

== Info ==

** Using settings from the current site**

If you choose this way, you should go to the plugin setting page.
Select option "Current site" from the options in the "Options source" select box. And set the count of the months in the education year, family income range and prices of the education per month in the settings fields.
If you correctly set all these fields, the calculation form on the client side of the site will be the calculated price of the education for the students per month and per year.

**Using settings from the remote site.**

If you choose this way, you should go to the plugin setting page and select option "Remote site" from the options in the "Options source" select box.
You don't need to set a count of the months in the education year, family income range and prices of the education per month. Because those settings were set on the remote site. You only should set the URL to a remote site without a slash at the end of the URL.
For example: "https://example.com".

If you correctly set the URL of the remote site, the calculation form on the client side of the site will use settings, which you set on the remote site, for the calculating prices of the education per month and per year.

**Insert form on the client side of the site**

For the adding Calculation form on the client side of the site, you may use the following shortcode:
[spc-calculator-form]

This shortcode you should paste this into the content or code fields in the page builder.
On the client side, this shortcode will be replaced with the calculating form.

In the shortcode you can use following parameters for changing labels and messages in the contact form:

    - label_number_students
    - label_household_income
    - label_checkbox
    - label_button
    - label_recalculate_button
    - label_results_header
    - label_per_month
    - label_per_year
    - label_info
    - error_label_students_number
    - error_label_income

For example, following code will be change label below Number students input.

[spc-calculator-form label_number_students="New label"]

Those parameters you can use in any combinations.