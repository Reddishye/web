<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksViewer extends Controller
{
    public function show(Request $request, $path = null)
    {
        if ($path === null) {
            return $this->showRootLinks();
        }

        $link = Link::where('path', $path)->first();

        if ($link) {
            return $this->handleLinkRedirect($link);
        }

        return $this->showCategoryLinks($path);
    }

    private function showRootLinks()
    {
        $rootLinks = Link::where('path', 'not like', '%/%')->get();
        $categories = Link::where('path', 'like', '%/%')
            ->get()
            ->map(function ($link) {
                return explode('/', $link->path)[0];
            })
            ->unique()
            ->values();

        $categoryLinks = $this->createCategoryLinks($categories);
        $allLinks = $rootLinks->merge($categoryLinks);

        return view('links', [
            'links' => $allLinks,
            'currentPath' => null,
            'previousPath' => null
        ]);
    }

    private function showCategoryLinks($path)
    {
        $links = Link::where('path', 'like', $path . '/%')->get();

        if ($links->isEmpty()) {
            abort(404);
        }

        $currentLinks = $links->filter(function ($link) use ($path) {
            return substr_count($link->path, '/') === substr_count($path, '/') + 1;
        });

        $subCategories = $links->filter(function ($link) use ($path) {
            return substr_count($link->path, '/') > substr_count($path, '/') + 1;
        })->map(function ($link) use ($path) {
            $subPath = substr($link->path, strlen($path) + 1);
            $nextCategory = explode('/', $subPath)[0];
            return $path . '/' . $nextCategory;
        })->unique()->values();

        $categoryLinks = $this->createCategoryLinks($subCategories);
        $allLinks = $currentLinks->merge($categoryLinks);

        $previousPath = $this->getPreviousPath($path);

        return view('links', [
            'links' => $allLinks,
            'currentPath' => $path,
            'previousPath' => $previousPath
        ]);
    }

    private function createCategoryLinks($categories)
    {
        return $categories->map(function ($category) {
            return new Link([
                'name' => ucfirst(basename($category)),
                'path' => $category,
                'link' => route('links.user', ['path' => $category]),
                'fa_icon' => 'fas fa-folder',
                'color' => '#6c757d',
            ]);
        });
    }

    private function getParentCategory($path)
    {
        $pathParts = explode('/', $path);
        if (count($pathParts) > 1) {
            array_pop($pathParts);
            $parentPath = implode('/', $pathParts);
            return [
                'name' => ucfirst(end($pathParts)),
                'path' => $parentPath,
                'url' => route('links.user', ['path' => $parentPath]),
            ];
        }
        return null;
    }

    private function getPreviousPath($path)
    {
        $pathParts = explode('/', $path);
        if (count($pathParts) > 1) {
            array_pop($pathParts);
            return implode('/', $pathParts) ?: '/';
        }
        return '/';
    }

    private function handleLinkRedirect(Link $link)
    {
        $linkType = $this->getLinkType($link->link);
        $linkContent = $this->getLinkContent($link->link);

        switch ($linkType) {
            case 'copy':
                return view('copy-link', ['textToCopy' => $linkContent]);
            case 'newwindow':
                return redirect()->away($linkContent);
            case 'route':
                return redirect()->route($linkContent);
            case 'onlyview':
                return back()->with('message', 'Este enlace es solo para visualización.');
            default:
                return redirect()->away($link->link);
        }
    }

    private function getLinkType($link)
    {
        $types = ['copy:', 'newwindow:', 'route:', 'onlyview'];
        foreach ($types as $type) {
            if (strpos($link, $type) === 0) {
                return rtrim($type, ':');
            }
        }
        return 'default';
    }

    private function getLinkContent($link)
    {
        $types = ['copy:', 'newwindow:', 'route:'];
        foreach ($types as $type) {
            if (strpos($link, $type) === 0) {
                return substr($link, strlen($type));
            }
        }
        return $link;
    }
}
