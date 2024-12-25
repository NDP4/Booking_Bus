// "use client";
import React, { useState, useEffect } from "react";
import {
    HoveredLink,
    Menu,
    MenuItem,
    ProductItem,
} from "../components/ui/navbar-menu"; // Sesuaikan path jika perlu
import { cn } from "../lib/utils"; // Pastikan utils berada di folder yang benar
// import { Cover } from "../components/ui/cover"; // Sesuaikan path jika perlu
import { FlipWords } from "../components/ui/flip-words"; // Sesuaikan path jika perlu
import { Button } from "../components/ui/moving-border";
import { BackgroundBeamsWithCollision } from "../components/ui/background-beams-with-collision";
import { HoverBorderGradient } from "../components/ui/hover-border-gradient";

export default function Home() {
    const words = ["Kenyamanan", "Keamanan", "Kepercayaan"];
    return (
        <html>
            <BackgroundBeamsWithCollision className="absolute z-0 inset-x-0 bottom-1"/>
            <div className="relative flex items-center justify-center w-full text-white dark:bg-gray-900">
                <Navbar className="top-2" />
                {/* <p className="text-black dark:text-white">
                    The Navbar will show on top of the page
                </p> */}
            </div>
            {/* <div>
                <h1 className="relative z-20 py-6 mx-auto mt-6 text-4xl font-semibold text-center text-transparent md:text-4xl lg:text-6xl max-w-7xl bg-clip-text bg-gradient-to-b from-neutral-800 via-neutral-700 to-neutral-700 dark:from-neutral-800 dark:via-white dark:to-white">
                    Build amazing websites <br /> at <Cover>warp speed</Cover>
                </h1>
            </div> */}
            <div className="h-[40rem] flex justify-center items-center px-4">
                <div className="z-10 mx-auto text-4xl font-normal text-neutral-600 dark:text-neutral-400">
                    Untuk
                    <FlipWords words={words} /> <br />
                    Kami hadir untuk anda
                </div>
            </div>
            {/* <div className="flex items-center justify-center space-x-4">
                <a href="http://localhost:8000/admin">
                    <Button
                        borderRadius="1.75rem"
                        className="text-black bg-white dark:bg-slate-900 dark:text-white border-neutral-200 dark:border-slate-800"
                    >
                        Login
                    </Button>
                </a>
                <a href="chatbot">
                    <Button
                        borderRadius="1.75rem"
                        className="text-black bg-white dark:bg-slate-900 dark:text-white border-neutral-200 dark:border-slate-800"
                    >
                        Tanya CS
                    </Button>
                </a>
            </div> */}
        </html>
    );
}

function Navbar({ className }) {
    const [active, setActive] = useState(null);
    return (
        <div className={cn("fixed top-10 inset-x-0 w-full mx-auto z-50", className)}>
            {/* Container utama dengan flex */}
            <div className="flex items-center justify-between mx-5">
                {/* Logo di kiri */}
                <div className="flex items-center justify-start min-w-48">
                    <img src="images/logo_rizky_putra_168.svg" className="w-12 h-12" alt="Logo" />
                </div>

                {/* Menu di tengah */}
                <Menu setActive={setActive} className="flex-grow flex justify-center">
                    <MenuItem setActive={setActive} active={active} item="Home">
                        {/* <HoveredLink href="/web-dev">Web Development</HoveredLink> */}
                    </MenuItem>
                    <MenuItem setActive={setActive} active={active} item="Bus">
                        {/* <HoveredLink href="/interface-design">Interface Design</HoveredLink> */}
                    </MenuItem>
                    <MenuItem setActive={setActive} active={active} item="Tentang Kami">
                        {/* <HoveredLink href="/hobby">Hobby</HoveredLink> */}
                    </MenuItem>
                </Menu>

                {/* Tombol kanan */}
                <div className="flex items-center justify-end min-w-48">
                    <HoverBorderGradient
                        containerClassName="rounded-full mx-1"
                        as="button"
                        className="dark:bg-black bg-white text-black dark:text-white flex items-center space-x-2">
                        <span>Login</span>
                    </HoverBorderGradient>
                    <HoverBorderGradient
                        containerClassName="rounded-full"
                        as="button"
                        className="dark:bg-black bg-white text-black dark:text-white flex items-center space-x-2">
                        <span>Tanya CS</span>
                    </HoverBorderGradient>
                </div>
            </div>
        </div>
    );
}

