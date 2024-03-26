<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LinksViewer extends Controller
{
    /**
     * Redirect to a specific link based on the path.
     */
    public function redirect(Request $request, $path = null)
    {
        if ($request->has('category')) {
            $category = strtolower($request->input('category'));
            return redirect()->route('links.redirect', ['path' => $category]);
        }

        if ($path === null) {
            $links = Link::where('path', 'not like', '%/%')->get();
            $categories = Link::select('path')
                ->where('path', 'like', '%/%')
                ->where('path', 'not like', '%/%/%')
                ->groupBy('path')
                ->get()
                ->map(function ($link) {
                    $categoryPath = substr($link->path, 0, strpos($link->path, '/'));
                    return [
                        'path' => $categoryPath,
                        'url' => route('links.redirect', ['path' => $categoryPath]),
                    ];
                })
                ->unique('path')
                ->values();

            $categoryLinks = $categories->map(function ($category) {
                $link = new Link();
                $link->name = ucfirst($category['path']);
                $link->path = 'redirect-' . $category['path'];
                $link->link = $category['url'];
                $link->fa_icon = 'fas fa-folder';
                $link->color = '#6c757d';
                return $link;
            });

            $links = $links->merge($categoryLinks);

            $isSection = false;
            $sectionLastSlash = null;

            return view('links', compact('links', 'categories', 'isSection', 'sectionLastSlash'));
        }

        $lowercasePath = strtolower($path);
        $link = Link::where('path', $lowercasePath)->first();

        if ($link) {
            return redirect()->away($link->link);
        }

        $links = Link::where('path', 'like', $lowercasePath . '/%')->get();

        if ($links->isNotEmpty()) {
            $mostCommonCase = $this->getMostCommonCase($links, $path);

            $categories = $links->map(function ($link) use ($lowercasePath, $mostCommonCase) {
                $categoryPath = substr($link->path, strlen($lowercasePath) + 1);
                $categoryName = strstr($categoryPath, '/', true);
                if ($categoryName !== false) {
                    return [
                        'path' => $categoryName,
                        'url' => route('links.redirect', ['path' => $lowercasePath . '/' . $categoryName]),
                        'case' => $mostCommonCase,
                    ];
                }
                return null;
            })->filter()->unique('path')->values();

            $categoryLinks = $categories->map(function ($category) use ($lowercasePath) {
                $link = new Link();
                $link->name = ucfirst($category['path']);
                $link->path = 'redirect-' . $category['path'];
                $link->link = $category['url'];
                $link->fa_icon = 'fas fa-folder';
                $link->color = '#6c757d';
                return $link;
            });

            $links = $links->merge($categoryLinks);

            $parentCategory = null;
            if (strpos($lowercasePath, '/') !== false) {
                $parentCategory = [
                    'path' => substr($lowercasePath, 0, strrpos($lowercasePath, '/')),
                    'url' => route('links.redirect', ['path' => substr($lowercasePath, 0, strrpos($lowercasePath, '/'))]),
                ];
            }

            $links = $links->map(function ($link) use ($lowercasePath, $mostCommonCase) {
                $link->path = substr($link->path, strlen($lowercasePath) + 1);
                $link->case = $mostCommonCase;
                return $link;
            });

            $currentCategory = [
                'path' => $lowercasePath,
                'url' => route('links.redirect', ['path' => $lowercasePath]),
                'case' => $mostCommonCase,
            ];

            $isSection = true;
            $sectionLastSlash = $mostCommonCase;

            return view('links', compact('links', 'categories', 'parentCategory', 'currentCategory', 'isSection', 'sectionLastSlash'));
        }

        abort(404);
    }

    private function getMostCommonCase($links, $path)
    {
        $pathCounts = [];

        foreach ($links as $link) {
            $lastSlash = basename(dirname($link->path));
            if (strtolower($lastSlash) === strtolower($path)) {
                if (!isset($pathCounts[$lastSlash])) {
                    $pathCounts[$lastSlash] = 0;
                }
                $pathCounts[$lastSlash]++;
            }
        }

        arsort($pathCounts);
        return key($pathCounts);
    }
}
