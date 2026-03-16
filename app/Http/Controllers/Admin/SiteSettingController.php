<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    private function deletePublicFilesFromSettingArray(mixed $data): void
    {
        if (!is_array($data)) {
            return;
        }

        $paths = [];

        $walk = function (mixed $value) use (&$walk, &$paths): void {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $walk($v);
                }
                return;
            }

            if (!is_string($value)) {
                return;
            }

            if (Str::startsWith($value, ['site/', 'site/home/', 'site/about/'])) {
                $paths[] = $value;
            }
        };

        $walk($data);

        $paths = array_values(array_unique($paths));
        foreach ($paths as $path) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * ✅ LOGO (frontend + backend sinkron)
     */
    public function editLogo()
    {
        $logoPath = SiteSetting::getValue('school_logo');
        $siteLogoUrl = $logoPath ? asset($logoPath) : asset('images/default-logo.png');

        return view('admin.settings.logo', [
            'siteLogoUrl' => $siteLogoUrl,
        ]);
    }

    public function updateLogo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'logo' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
        ]);

        $file = $request->file('logo');
        $fileName = 'logo.' . $file->getClientOriginalExtension();

        $destination = public_path('images');
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        $file->move($destination, $fileName);

        $oldPath = SiteSetting::getValue('school_logo');
        if ($oldPath && file_exists(public_path($oldPath)) && $oldPath !== 'images/logo.png') {
            @unlink(public_path($oldPath));
        }

        SiteSetting::setValue('school_logo', 'images/' . $fileName);

        return back()->with('status', 'logo_updated');
    }

    /**
     * ✅ HALAMAN HOME
     */
    public function editHome()
    {
        $raw = SiteSetting::getValue('home_page');
        $data = $raw ? json_decode($raw, true) : [];

        $toUrl = fn(?string $path): ?string => $path ? Storage::url($path) : null;

        if (!empty($data['hero']['image'])) {
            $data['hero']['image_url'] = $toUrl($data['hero']['image']);
        }
        if (!empty($data['principal']['image'])) {
            $data['principal']['image_url'] = $toUrl($data['principal']['image']);
        }

        return view('admin.settings.home', ['data' => $data]);
    }

    /**
     * ✅ HALAMAN ABOUT
     */
    public function editAbout()
    {
        $data = SiteSetting::getValue('about_page');
        return view('admin.settings.about', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

    /**
     * ✅ HALAMAN ACADEMIC
     */
    public function editAcademic()
    {
        $data = SiteSetting::getValue('academic_page');
        return view('admin.settings.academic', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

    /**
     * ✅ HALAMAN FACILITIES
     */
    public function editFacilities()
    {
        $data = SiteSetting::getValue('facilities_page');
        return view('admin.settings.facilities', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

        public function updateFacilities(Request $request): RedirectResponse
        {
            $existing = SiteSetting::getValue('facilities_page');
            $existingData = $existing ? json_decode($existing, true) : ['sections' => []];

            $sections = [];
            $inputSections = $request->input('sections', []);
            $files = $request->file('sections', []);

            foreach ($inputSections as $i => $sectionInput) {
                $section = [
                    'title' => $sectionInput['title'] ?? '',
                    'text'  => $sectionInput['text'] ?? '',
                ];

                if (!empty($files[$i]['image']) && $files[$i]['image']->isValid()) {
                    $oldImage = $sectionInput['existing_image'] ?? null;
                    if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                    $path = $files[$i]['image']->store('site/facilities', 'public');
                    $section['image'] = $path;
                    $section['image_url'] = Storage::url($path);
                } else {
                    $section['image'] = $sectionInput['existing_image'] ?? null;
                    $section['image_url'] = $section['image'] ? Storage::url($section['image']) : null;
                }

                $sections[] = $section;
            }

            SiteSetting::setValue('facilities_page', json_encode(['sections' => $sections], JSON_PRETTY_PRINT));

            return back()->with('status', 'facilities_updated');
        }

        public function resetFacilities(): RedirectResponse
        {
            SiteSetting::deleteValue('facilities_page');
            return back()->with('status', 'facilities_reset');
        }

        public function destroyFacilities(): RedirectResponse
        {
            SiteSetting::deleteValue('facilities_page');
            return back()->with('status', 'facilities_deleted');
        }

    /**
     * ✅ HALAMAN STUDENT LIFE
     */
    public function editStudentLife()
    {
        $data = SiteSetting::getValue('student_life_page');
        return view('admin.settings.student-life', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

    public function updateStudentLife(Request $request): RedirectResponse
    {
        // Ambil semua data dari form
        $data = $request->except(['_token']);
        // Simpan sebagai JSON baru, menggantikan data lama sepenuhnya
        SiteSetting::setValue('student_life_page', json_encode($data, JSON_PRETTY_PRINT));

        return back()->with('status', 'student_life_updated');
    }

    public function resetStudentLife(): RedirectResponse
    {
        SiteSetting::deleteValue('student_life_page');
        return back()->with('status', 'student_life_reset');
    }

    public function destroyStudentLife(): RedirectResponse
    {
        SiteSetting::deleteValue('student_life_page');
        return back()->with('status', 'student_life_deleted');
    }

    /**
     * ✅ HALAMAN INFORMATION
     */
    public function editInformation()
    {
        $data = SiteSetting::getValue('information_page');
        return view('admin.settings.information', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

    public function updateInformation(Request $request): RedirectResponse
    {
        $data = $request->except(['_token']);
        SiteSetting::setValue('information_page', json_encode($data, JSON_PRETTY_PRINT));
        return back()->with('status', 'information_updated');
    }

    public function resetInformation(): RedirectResponse
    {
        SiteSetting::deleteValue('information_page');
        return back()->with('status', 'information_reset');
    }

    public function destroyInformation(): RedirectResponse
    {
        SiteSetting::deleteValue('information_page');
        return back()->with('status', 'information_deleted');
    }

    /**
     * ✅ HALAMAN CONTACT
     */
    public function editContact()
    {
        $data = SiteSetting::getValue('contact_page');
        return view('admin.settings.contact', [
            'data' => $data ? json_decode($data, true) : [],
        ]);
    }

    private function normalizeFooterItems(mixed $items, array $fields): array
    {
        if (!is_array($items)) {
            return [];
        }

        $normalized = [];

        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }

            $row = [];
            $hasContent = false;

            foreach ($fields as $field) {
                $value = trim((string) ($item[$field] ?? ''));
                $row[$field] = $value;
                $hasContent = $hasContent || $value !== '';
            }

            if ($hasContent) {
                $normalized[] = $row;
            }
        }

        return $normalized;
    }

    public function editFooter()
    {
        return view('admin.settings.footer', [
            'data' => SiteSetting::getFooterData(),
            'hasStoredData' => SiteSetting::getValue('footer_content') !== null,
        ]);
    }

    public function updateFooter(Request $request): RedirectResponse
    {
        $defaults = SiteSetting::getFooterDefaults();

        $data = [
            'brand_name' => trim((string) $request->input('brand_name', $defaults['brand_name'])),
            'brand_description' => trim((string) $request->input('brand_description', $defaults['brand_description'])),
            'address' => trim((string) $request->input('address', $defaults['address'])),
            'email' => trim((string) $request->input('email', $defaults['email'])),
            'phone' => trim((string) $request->input('phone', $defaults['phone'])),
            'map_embed_url' => trim((string) $request->input('map_embed_url', $defaults['map_embed_url'])),
            'quick_links_title' => trim((string) $request->input('quick_links_title', $defaults['quick_links_title'])),
            'quick_links' => $this->normalizeFooterItems($request->input('quick_links', []), ['label', 'url']),
            'programs_title' => trim((string) $request->input('programs_title', $defaults['programs_title'])),
            'programs' => $this->normalizeFooterItems($request->input('programs', []), ['label', 'url', 'icon']),
            'social_title' => trim((string) $request->input('social_title', $defaults['social_title'])),
            'social_description' => trim((string) $request->input('social_description', $defaults['social_description'])),
            'social_links' => $this->normalizeFooterItems($request->input('social_links', []), ['platform', 'url', 'icon']),
            'newsletter_enabled' => $request->boolean('newsletter_enabled') ? '1' : '0',
            'newsletter_title' => trim((string) $request->input('newsletter_title', $defaults['newsletter_title'])),
            'newsletter_placeholder' => trim((string) $request->input('newsletter_placeholder', $defaults['newsletter_placeholder'])),
            'newsletter_button_text' => trim((string) $request->input('newsletter_button_text', $defaults['newsletter_button_text'])),
            'bottom_copyright' => trim((string) $request->input('bottom_copyright', $defaults['bottom_copyright'])),
            'bottom_links' => $this->normalizeFooterItems($request->input('bottom_links', []), ['label', 'url']),
        ];

        SiteSetting::setValue('footer_content', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return back()->with('status', 'footer_updated');
    }

    public function resetFooter(): RedirectResponse
    {
        SiteSetting::deleteValue('footer_content');

        return back()->with('status', 'footer_reset');
    }

    public function destroyFooter(): RedirectResponse
    {
        SiteSetting::deleteValue('footer_content');

        return back()->with('status', 'footer_deleted');
    }
}


