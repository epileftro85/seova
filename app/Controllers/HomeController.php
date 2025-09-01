<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Requests\ContactRequest;
use App\Utils\View;
use App\Utils\Response;

class HomeController extends Controller
{
    private $faqList = [
        ["What is a virtual SEO assistant?", "A virtual SEO assistant provides professional search engine optimization services remotely. At Seova, we handle the technical and strategic tasks that improve your website's visibility, freeing you up to focus on running your business. We act as an extension of your team, providing the expertise of a dedicated SEO specialist without the overhead of a full-time hire."],
        ["What makes Seova different from other SEO agencies?", "Our unique value proposition is our dual expertise: we combine data analysis with SEO implementation. While many services focus on one or the other, our partnership of a technical expert and a data analyst ensures every action we take is based on hard data and directly ties back to your business goals. We're focused on measurable growth, not just traffic."],
        ["How does your service help small businesses?", "Small businesses often lack the resources for a full-time marketing team. Our virtual SEO assistant service provides a flexible and affordable solution. We help you compete with larger competitors by optimizing your online presence, improving your website's performance, and helping you attract qualified leads without a massive marketing budget."],
        ["What kind of results can I expect?", "Our focus is on delivering measurable results that align with your specific business goals. We'll track key performance indicators (KPIs) like organic traffic growth, keyword rankings, qualified lead generation, and ultimately, return on investment (ROI). Our automated reporting dashboards provide real-time visibility into these metrics so you can see the impact of our work."],
        ["How long does it take to see results from SEO?", "SEO is a long-term investment, not a quick fix. While you may see some initial improvements within 3 to 6 months, significant results often take 6 to 12 months or longer. Our strategic approach builds a strong foundation that provides sustainable growth over time."],
        ["Do I have to sign a long-term contract?", "We believe our results speak for themselves. While we recommend a minimum engagement of 6 months to establish a solid foundation and see measurable results, we offer flexible packages designed to suit your needs. We are transparent about our pricing and services, and there are no hidden fees."],
        ["What is a website health audit?", "A website health audit is a comprehensive analysis of your website's technical performance. We inspect elements like site speed, mobile-friendliness, crawlability, and security. Our audit identifies technical issues that could be hindering your SEO performance and provides a clear plan for how to fix them."],
        ["How do you handle keyword strategy?", "Our keyword strategy goes beyond finding high-volume terms. We use a data-driven approach to identify keywords that are most likely to attract your ideal customers and convert them into paying clients. We analyze competitor data and user intent to build a strategy that drives qualified traffic to your site."],
        ["How do I get started?", "Getting started is simple. Just contact us through the form on our website to schedule a free initial consultation. We'll discuss your business goals, assess your current online presence, and provide a clear, actionable plan to help you achieve measurable growth. There’s no obligation, and we’ll answer all your questions."],
        ["Can you work with any type of website?", "We have experience working with a wide range of content management systems (CMS) and website platforms, including WordPress, Shopify, and custom-built sites. Our technical skills allow us to adapt to your specific platform to implement effective SEO strategies."],
        ["What is SEO?", "SEO, or Search Engine Optimization, is the practice of improving your website to increase its visibility when people search for products or services related to your business on search engines like Google. A strong SEO strategy can lead to more organic traffic, higher rankings, and increased conversions."],
        ["Why is SEO important for my business?", "SEO is crucial because it helps potential customers find your business online. Unlike paid advertising, which stops working when you stop paying, SEO builds long-term authority and a steady stream of organic traffic. A strong online presence is essential for building brand trust and driving sustainable business growth."],
        ["What is the difference between on-page and off-page SEO?", "On-page SEO refers to all the optimization actions you can take directly on your website, such as optimizing content, images, and HTML source code. Off-page SEO refers to actions taken outside of your website to impact your rankings, such as building backlinks from other reputable websites to your site."],
        ["What are backlinks and why do they matter?", "Backlinks are links from one website to a page on another website. They are a crucial ranking factor for search engines, as they signal that other websites consider your content to be valuable. A strong backlink profile from high-quality, authoritative sites can significantly boost your website's authority and search rankings."],
        ["How do you measure the success of an SEO campaign?", "We measure success using a variety of key performance indicators (KPIs) tailored to your business goals. This includes changes in organic traffic, keyword rankings, qualified lead generation, conversion rates, and the return on investment (ROI) of our efforts. We provide a custom, automated dashboard for real-time tracking of these metrics."]
    ];
    public function home()
    {
        View::make()
            ->with([
                'title' => 'Data-Driven SEO for Small Business Growth | Seova',
                'description' => 'Seova provides data-driven SEO virtual assistant services. Our  technical experts and a data analyst helps small businesses achieve measurable growth.',
                'csrf' => $this->set_csrf(),
                'javascript' => [
                    'js/jquery-3.3.1.min.js',
                    'js/singlePageNav.min.js',
                    'js/parallax.min.js',
                    'js/main.js'
                ],
                'headjs' => [],
                'stylesheets' => [
                    'fontawesome/css/all.min.css',
                    'css/bootstrap.min.css',
                    'css/main.css'
                ],
                'faqList' => $this->faqList,
            ])
            ->display('home', 'layout');
    }

    public function contact()
    {
        $request = new ContactRequest();

        // Validate the request
        if (!$request->validate()) {
            if (Response::wantsJson()) {
                Response::validationErrors($request->errors(), 'Contact form validation failed');
            } else {
                Response::htmlError('Please correct the following errors:', 400, $request->errors());
            }
            return;
        }

        // Verify CSRF token
        if (!$this->verify_csrf($request->input('csrf_token'))) {
            if (Response::wantsJson()) {
                Response::error('Security token validation failed', [], 403);
            } else {
                Response::htmlError('Security token validation failed', 403);
            }
            return;
        }

        try {
            Response::success('Your message has been sent successfully!', ['redirect' => '/']);
        } catch (\Throwable $e) {
            Response::error('Failed to send your message: ' . $e->getMessage(), [], 400);
        }
    }

    public function daruma()
    {
        View::make()
            ->with([
                'title' => 'Data-Driven SEO for Small Business Growth | Seova',
                'description' => 'Seova provides data-driven SEO virtual assistant services. Our  technical experts and a data analyst helps small businesses achieve measurable growth.',
                'csrf' => $this->set_csrf(),
                'javascript' => [
                    '/js/main.js'
                ],
                'headjs' => [],
                'stylesheets' => [
                    '/fontawesome/css/all.min.css',
                    '/css/bootstrap.min.css',
                    '/css/main.css'
                ]
            ])
            ->display('clients/daruma', 'layout');
    }
}
