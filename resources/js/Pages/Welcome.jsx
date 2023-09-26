import { DocumentIcon } from "@heroicons/react/24/outline";
import { Link, Head } from "@inertiajs/react";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

export default function Welcome({ blog }) {
    console.log(blog);
    return (
        <>
            <Head title="Hello" />
            <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div className="pt-16">
                    <div className="flex">
                        <div className="px-4">
                            <img
                                className="inline-block h-14 w-14 rounded-full"
                                src="pp.jpg"
                                alt=""
                            />
                        </div>
                        <div className="px-4 sm:px-0">
                            <h3 className="text-base font-semibold leading-7 text-gray-900">
                                Hello, World!
                            </h3>
                            <p className="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                                👋 Hey, welcome to my website!
                            </p>
                        </div>
                    </div>
                    <div className="mt-6 border-t border-gray-100">
                        <dl className="divide-y divide-gray-100">
                            <div className="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt className="text-sm font-medium leading-6 text-gray-900">
                                    About Me
                                </dt>
                                <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                    I am a software developer and a remote
                                    developer advocate. I co-run a few companies
                                    and I am always building more. I tinker
                                    around with server side development, DevOps,
                                    AI/ML, and web development. I also love OSS
                                    and have regularly contributed to NodeJS and
                                    Freecodecamp. I live on the web, so don't be
                                    shy and reach out to me on Twitter or
                                    LinkedIn.
                                </dd>
                            </div>
                            <div className="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt className="text-sm font-medium leading-6 text-gray-900">
                                    Blog
                                </dt>
                                <dd className="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <ul
                                        role="list"
                                        className="divide-y divide-gray-100 rounded-md border border-gray-200"
                                    >
                                        {blog.map((post) => (
                                            <li className="flex flex-col md:flex-row items-start md:items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                <div className="flex w-full md:w-0 flex-1 items-center mb-2 md:mb-0">
                                                    <div className="ml-4 flex flex-col min-w-0 flex-1 gap-2">
                                                        <Link
                                                            href={`/blog/${post.slug}`}
                                                            className="break-normal font-medium w-auto text-indigo-600 hover:text-indigo-500 truncate"
                                                            style={{
                                                                maxWidth: "90%",
                                                            }} // Ensure there's a max-width for truncation to work
                                                        >
                                                            {post.title}
                                                        </Link>
                                                        <span className="flex-shrink-0 text-gray-400">
                                                            {post.description}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div className="ml-4 flex-shrink-0">
                                                    <span className="flex-shrink-0 text-gray-400">
                                                        {dayjs(
                                                            post.date
                                                        ).fromNow()}
                                                    </span>
                                                </div>
                                            </li>
                                        ))}
                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </>
    );
}
