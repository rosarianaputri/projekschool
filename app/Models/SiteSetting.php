<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $record = static::query()->where('key', $key)->first();

        return $record?->value ?? $default;
    }

    public static function setValue(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function deleteValue(string $key): void
    {
        static::query()->where('key', $key)->delete();
    }

    public static function getFooterDefaults(): array
    {
        return [
            'brand_name' => 'Layla School',
            'brand_description' => 'Empowering students with quality education and innovative learning experiences since 2020.',
            'address' => "123 Learning Street\nEducation City, Country 12345",
            'email' => 'info@laylaschool.com',
            'phone' => '+62 123 4567 890',
            'map_embed_url' => 'https://www.google.com/maps?q=Jakarta&output=embed',
            'quick_links_title' => 'Quick Links',
            'quick_links' => [
                ['label' => 'Home', 'url' => '/home'],
                ['label' => 'About Us', 'url' => '/about'],
                ['label' => 'Academic', 'url' => '/academic'],
                ['label' => 'Facilities', 'url' => '/facilities'],
                ['label' => 'Student Life', 'url' => '/student-life'],
                ['label' => 'Information', 'url' => '/information'],
                ['label' => 'Contact Us', 'url' => '/contact'],
            ],
            'programs_title' => 'Programs',
            'programs' => [
                ['label' => 'Elementary', 'url' => '#', 'icon' => 'fas fa-book'],
                ['label' => 'Middle School', 'url' => '#', 'icon' => 'fas fa-graduation-cap'],
                ['label' => 'High School', 'url' => '#', 'icon' => 'fas fa-university'],
                ['label' => 'Science Lab', 'url' => '#', 'icon' => 'fas fa-flask'],
            ],
            'social_title' => 'Connect With Us',
            'social_description' => 'Follow us on social media for updates and news.',
            'social_links' => [
                ['platform' => 'Facebook', 'url' => '#', 'icon' => 'fab fa-facebook-f'],
                ['platform' => 'Twitter', 'url' => '#', 'icon' => 'fab fa-twitter'],
                ['platform' => 'Instagram', 'url' => '#', 'icon' => 'fab fa-instagram'],
                ['platform' => 'YouTube', 'url' => '#', 'icon' => 'fab fa-youtube'],
                ['platform' => 'LinkedIn', 'url' => '#', 'icon' => 'fab fa-linkedin-in'],
            ],
            'newsletter_enabled' => '1',
            'newsletter_title' => 'Subscribe to Newsletter',
            'newsletter_placeholder' => 'Your email',
            'newsletter_button_text' => 'Subscribe',
            'bottom_copyright' => 'Copyright {year} Layla School. All Rights Reserved.',
            'bottom_links' => [
                ['label' => 'Privacy Policy', 'url' => '#'],
                ['label' => 'Terms of Service', 'url' => '#'],
                ['label' => 'Sitemap', 'url' => '#'],
            ],
        ];
    }

    public static function getFooterData(): array
    {
        $defaults = static::getFooterDefaults();
        $raw = static::getValue('footer_content');

        if (!$raw) {
            return $defaults;
        }

        $data = json_decode($raw, true);
        if (!is_array($data)) {
            return $defaults;
        }

        $normalizeItems = static function (mixed $items, array $itemDefaults, array $fallback): array {
            if (!is_array($items)) {
                return $fallback;
            }

            $normalized = [];
            foreach ($items as $item) {
                if (!is_array($item)) {
                    continue;
                }

                $normalized[] = array_merge($itemDefaults, $item);
            }

            return $normalized ?: $fallback;
        };

        return [
            'brand_name' => $data['brand_name'] ?? $defaults['brand_name'],
            'brand_description' => $data['brand_description'] ?? $defaults['brand_description'],
            'address' => $data['address'] ?? $defaults['address'],
            'email' => $data['email'] ?? $defaults['email'],
            'phone' => $data['phone'] ?? $defaults['phone'],
            'map_embed_url' => $data['map_embed_url'] ?? $defaults['map_embed_url'],
            'quick_links_title' => $data['quick_links_title'] ?? $defaults['quick_links_title'],
            'quick_links' => $normalizeItems($data['quick_links'] ?? null, ['label' => '', 'url' => ''], $defaults['quick_links']),
            'programs_title' => $data['programs_title'] ?? $defaults['programs_title'],
            'programs' => $normalizeItems($data['programs'] ?? null, ['label' => '', 'url' => '', 'icon' => 'fas fa-circle'], $defaults['programs']),
            'social_title' => $data['social_title'] ?? $defaults['social_title'],
            'social_description' => $data['social_description'] ?? $defaults['social_description'],
            'social_links' => $normalizeItems($data['social_links'] ?? null, ['platform' => '', 'url' => '', 'icon' => 'fab fa-linkedin-in'], $defaults['social_links']),
            'newsletter_enabled' => (string) ($data['newsletter_enabled'] ?? $defaults['newsletter_enabled']),
            'newsletter_title' => $data['newsletter_title'] ?? $defaults['newsletter_title'],
            'newsletter_placeholder' => $data['newsletter_placeholder'] ?? $defaults['newsletter_placeholder'],
            'newsletter_button_text' => $data['newsletter_button_text'] ?? $defaults['newsletter_button_text'],
            'bottom_copyright' => $data['bottom_copyright'] ?? $defaults['bottom_copyright'],
            'bottom_links' => $normalizeItems($data['bottom_links'] ?? null, ['label' => '', 'url' => ''], $defaults['bottom_links']),
        ];
    }
}
