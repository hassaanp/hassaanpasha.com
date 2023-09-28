import { Head, Link } from "@inertiajs/react";
import DOMPurify from "dompurify";
import { marked } from "marked";
import { HomeIcon } from "@heroicons/react/20/solid";

export default function Post({ post }) {
    return (
        <>
            <Head title={post.title}>
                <meta name="twitter:card" content="summary_large_image" />
                <meta name="twitter:site" content="@hassaan_pasha" />
                <meta name="twitter:creator" content="@hassaan_pasha" />
                <meta name="twitter:title" content={post.title} />
                <meta name="twitter:description" content={post.description} />
                <meta
                    name="twitter:image"
                    content={`https://${window.location.host}/storage/screenshots/${post.slug}.jpg`}
                />
                <meta
                    name="twitter:image:alt"
                    content={post.title + " - " + post.description}
                />
                {/* Open Graph meta tags */}
                <meta property="og:title" content={post.title} />
                <meta property="og:description" content={post.description} />
                <meta
                    property="og:image"
                    content={`https://${window.location.host}/storage/screenshots/${post.slug}.jpg`}
                />
                <meta property="og:url" content={window.location.href} />
                <meta property="og:type" content="article" />
                <meta property="og:site_name" content="Hassaan's Blog" />
            </Head>
            <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div className="pt-16">
                    <div className="flex">
                        <div className="px-4">
                            <Link href="/">
                                <img
                                    className="inline-block w-14 rounded-full object-cover object-center"
                                    src="/pp.jpg"
                                    alt=""
                                />
                            </Link>
                        </div>
                        <div className="px-4 sm:px-0">
                            <h3 className="text-base font-semibold leading-7 text-gray-900">
                                {post.title}
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                                👋 {post.description}
                            </p>
                        </div>
                    </div>
                </div>

                <div className="pt-12 px-4 pb-24">
                    <div
                        className="prose flex-grow max-w-none"
                        dangerouslySetInnerHTML={{
                            __html: marked(post.content),
                        }}
                    ></div>
                </div>
            </div>
        </>
    );
}
