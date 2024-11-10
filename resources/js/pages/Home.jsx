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

export default function Home() {
    const words = ["Kenyamanan", "Keamanan", "Kepercayaan"];
    return (
        <html>
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
                <div className="mx-auto text-4xl font-normal text-neutral-600 dark:text-neutral-400">
                    Untuk
                    <FlipWords words={words} /> <br />
                    Kami hadir untuk anda
                </div>
            </div>
            <div className="flex items-center justify-center space-x-4">
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
            </div>
        </html>
    );
}

function Navbar({ className }) {
    const [active, setActive] = useState(null);
    return (
        <div
            className={cn(
                "fixed top-10 inset-x-0 max-w-2xl mx-auto z-50",
                className
            )}
        >
            <Menu setActive={setActive}>
                <MenuItem setActive={setActive} active={active} item="Home">
                    {/* <div className="flex flex-col space-y-4 text-sm">
                        <HoveredLink href="/web-dev">
                            Web Development
                        </HoveredLink>
                        <HoveredLink href="/interface-design">
                            Interface Design
                        </HoveredLink>
                        <HoveredLink href="/seo">
                            Search Engine Optimization
                        </HoveredLink>
                        <HoveredLink href="/branding">Branding</HoveredLink>
                    </div> */}
                </MenuItem>
                <MenuItem setActive={setActive} active={active} item="Bus">
                    {/* <div className="grid grid-cols-2 gap-10 p-4 text-sm ">
                        <ProductItem
                            title="Algochurn"
                            href="https://algochurn.com"
                            src="https://assets.aceternity.com/demos/algochurn.webp"
                            description="Prepare for tech interviews like never before."
                        />
                        <ProductItem
                            title="Tailwind Master Kit"
                            href="https://tailwindmasterkit.com"
                            src="https://assets.aceternity.com/demos/tailwindmasterkit.webp"
                            description="Production ready Tailwind css components for your next project"
                        />
                        <ProductItem
                            title="Moonbeam"
                            href="https://gomoonbeam.com"
                            src="https://assets.aceternity.com/demos/Screenshot+2024-02-21+at+11.51.31%E2%80%AFPM.png"
                            description="Never write from scratch again. Go from idea to blog in minutes."
                        />
                        <ProductItem
                            title="Rogue"
                            href="https://userogue.com"
                            src="https://assets.aceternity.com/demos/Screenshot+2024-02-21+at+11.47.07%E2%80%AFPM.png"
                            description="Respond to government RFPs, RFIs and RFQs 10x faster using AI"
                        />
                    </div> */}
                </MenuItem>
                <MenuItem
                    setActive={setActive}
                    active={active}
                    item="Tentang Kami"
                >
                    {/* <div className="flex flex-col space-y-4 text-sm">
                        <HoveredLink href="/hobby">Hobby</HoveredLink>
                        <HoveredLink href="/individual">Individual</HoveredLink>
                        <HoveredLink href="/team">Team</HoveredLink>
                        <HoveredLink href="/enterprise">Enterprise</HoveredLink>
                    </div> */}
                </MenuItem>
            </Menu>
        </div>
    );
}

