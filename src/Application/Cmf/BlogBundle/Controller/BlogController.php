<?php

/*
 * This file is part of the Symfony CMF package.
 *
 * (c) 2011-2014 Symfony CMF
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Cmf\BlogBundle\Controller;

use Symfony\Cmf\Bundle\BlogBundle\Controller\BlogController as BaseBlog;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Cmf\Bundle\BlogBundle\Model\Blog; 

class BlogController extends BaseBlog
{

    /**
     * Blog detail - list posts in a blog, optionally paginated.
     */
    public function detailAction(Request $request, Blog $contentDocument, $contentTemplate = NULL)
    {
        $blog = $contentDocument;

        $posts = $this->postRepository->search(array(
            'blogId' => $blog->getId(),
        ));

        if ($this->postsPerPage) {
            $posts = $this->paginator->paginate(
                $posts,
                $request->query->get('page', 1),
                $this->postsPerPage
            );
        }

        $templateFilename = $this->postsPerPage ? 'detailPaginated' : 'detail';
        $contentTemplate = $this->getTemplateForResponse(
            $request,
            $contentTemplate ?: sprintf('CmfBlogBundle:Blog:%s.{_format}.twig', $templateFilename)
        );

        $blogs = $this->blogRepository->findAll();
        return $this->renderResponse($contentTemplate, compact('blog', 'posts', 'pager', 'blogs'));
    }
}
