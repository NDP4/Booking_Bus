import React from "react";

export default function Home({ nama }) {
    return (
        <div className="flex flex-col h-screen">
            {/* Navbar */}
            {/* <nav className="fixed top-0 left-0 w-full py-4 transition duration-300 bg-transparent">
                <div className="container flex justify-between p-0.5 mx-auto">
                    <a href="#" className="text-lg font-bold text-white">
                        <img
                            src="/images/logo_rizky_putra_168.svg"
                            alt="Po. Rizky Putra 168"
                            className="inline-block w-10 h-12 text-white"
                        />
                        {nama}
                    </a>
                    <ul className="flex justify-end">
                        <li className="px-2 mr-4">
                            <a
                                href="#"
                                className="text-white hover:text-gray-200"
                            >
                                Beranda
                            </a>
                        </li>
                        <li className="px-2 mr-4">
                            <a
                                href="#"
                                className="text-white hover:text-gray-200"
                            >
                                Tentang Kami
                            </a>
                        </li>
                        <li className="px-2">
                            <a
                                href="#"
                                className="text-white hover:text-gray-200"
                            >
                                Hubungi Kami
                            </a>
                        </li>
                    </ul>
                </div>
            </nav> */}


            {/* Hero Section */}
            <section
                className="h-screen bg-center bg-cover hero"
                style={{
                    backgroundImage: "url(/images/bgimg.jpg)",
                    minHeight: "90vh",
                }}
            >
                <div className="container flex items-center justify-center h-full p-4 mx-auto">
                    <div className="flex flex-col">
                        <div className="flex flex-col mb-4">
                            <h1 className="text-4xl font-bold text-white">
                                Booking Bus Pariwisata Online yang Mudah dan
                                Aman
                            </h1>
                            <p className="text-lg text-white">
                                Dapatkan harga terbaik untuk perjalanan
                                pariwisata Anda dengan {nama}
                            </p>
                        </div>
                        <div className="flex flex-row space-x-4">
                            <a
                                href="/admin"
                                className="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700"
                            >
                                Masuk Sekarang
                            </a>
                            <button
                                type="button"
                                className="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700"
                                onClick={() => (location.href = "/chatbot")}
                            >
                                Tanya CS
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-12 bg-white">
                <div className="container p-4 mx-auto">
                    <h2 className="text-3xl font-bold text-blue-600">
                        Kenapa Memilih Kami?
                    </h2>
                    <ul className="flex flex-wrap justify-center">
                        <li className="w-1/3 p-4 lg:w-1/4">
                            <i className="text-4xl text-blue-600 fas fa-lock" />
                            <h3 className="text-lg font-bold text-blue-600">
                                Aman dan Terpercaya
                            </h3>
                            <p className="text-gray-600">
                                Kami memastikan keselamatan dan keamanan dalam
                                setiap perjalanan pariwisata Anda.
                            </p>
                        </li>
                        <li className="w-1/3 p-4 lg:w-1/4">
                            <i className="text-4xl text-blue-600 fas fa-clock" />
                            <h3 className="text-lg font-bold text-blue-600">
                                Cepat dan Efisien
                            </h3>
                            <p className="text-gray-600">
                                Kami membantu Anda mencari bus pariwisata dengan
                                cepat dan efisien.
                            </p>
                        </li>
                        <li className="w-1/3 p-4 lg:w-1/4">
                            <i className="text-4xl text-blue-600 fas fa-money-bill-alt" />
                            <h3 className="text-lg font-bold text-blue-600">
                                Harga Yang Kompetitif
                            </h3>
                            <p className="text-gray-600">
                                Kami menawarkan harga terbaik untuk perjalanan
                                pariwisata Anda.
                            </p>
                        </li>
                    </ul>
                </div>
            </section>

            {/* Call to Action Section */}
            <section className="py-12 bg-blue-600">
                <div className="container p-4 mx-auto">
                    <h2 className="text-3xl font-bold text-white">
                        Mulai Booking Bus Pariwisata Anda Sekarang!
                    </h2>
                    <button className="btn btn-white">Booking Sekarang</button>
                </div>
            </section>

            {/* Footer */}
            <footer className="py-4 bg-gray-200">
                <div className="container p-4 mx-auto">
                    <p className="text-gray-600">
                        copyright {new Date().getFullYear()} {nama}
                        168. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    );
}
