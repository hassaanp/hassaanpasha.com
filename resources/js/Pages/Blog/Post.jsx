import { Head, Link } from "@inertiajs/react";
import DOMPurify from "dompurify";
import { marked } from "marked";
import { HomeIcon } from "@heroicons/react/20/solid";

export default function Post({ post }) {
    return (
        <>
            <Head title={post.title} />
            <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div className="pt-4 w-full">
                    <Link
                        href="/"
                        className="text-gray-500 hover:text-gray-700"
                    >
                        Home
                    </Link>
                </div>
                <div className="pt-12">
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
