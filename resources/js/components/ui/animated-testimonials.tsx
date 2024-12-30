"use client";

import { IconArrowLeft, IconArrowRight } from "@tabler/icons-react";
import { motion, AnimatePresence } from "framer-motion";
import React, { useEffect, useState } from "react";

type Testimonial = {
    quote: string;
    name: string;
    designation: string;
    src: string;
};

export const AnimatedTestimonials = ({
    testimonials = [],
    autoplay = false,
}: {
    testimonials?: Testimonial[];
    autoplay?: boolean;
}) => {
    // Add debugging to track testimonials and current active index
    console.log("Received testimonials:", testimonials);

    if (!testimonials || testimonials.length === 0) {
        return null;
    }

    const [active, setActive] = useState(0);

    // Modified navigation handlers with logging
    const handleNext = () => {
        const nextIndex = (active + 1) % testimonials.length;
        console.log(`Moving to next testimonial: ${nextIndex}`);
        setActive(nextIndex);
    };

    const handlePrev = () => {
        const prevIndex =
            (active - 1 + testimonials.length) % testimonials.length;
        console.log(`Moving to previous testimonial: ${prevIndex}`);
        setActive(prevIndex);
    };

    // Add logging to track active changes
    useEffect(() => {
        console.log("Current active testimonial:", active);
        console.log("Current testimonial data:", testimonials[active]);
    }, [active, testimonials]);

    const isActive = (index: number) => {
        return index === active;
    };

    useEffect(() => {
        if (autoplay && testimonials.length > 1) {
            // Only autoplay if there are multiple testimonials
            const interval = setInterval(handleNext, 5000);
            return () => clearInterval(interval);
        }
    }, [autoplay, testimonials.length]);

    const randomRotateY = () => {
        return Math.floor(Math.random() * 21) - 10;
    };

    return (
        <div className="max-w-sm px-4 py-20 mx-auto font-sans antialiased md:max-w-4xl md:px-8 lg:px-12">
            {/* Add debug info */}
            <div className="mb-4 text-sm text-gray-500">
                Showing testimonial {active + 1} of {testimonials.length}
            </div>

            <div className="relative grid grid-cols-1 gap-20 md:grid-cols-2">
                {/* Left side - Image */}
                <div>
                    <div className="relative w-full h-80">
                        <AnimatePresence mode="wait">
                            <motion.div
                                key={active} // Changed to use active index as key
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                exit={{ opacity: 0 }}
                                className="absolute inset-0"
                            >
                                <img
                                    src={testimonials[active].src}
                                    alt={testimonials[active].name}
                                    draggable={false}
                                    className="object-cover object-center w-full h-full rounded-3xl"
                                />
                            </motion.div>
                        </AnimatePresence>
                    </div>
                </div>

                {/* Right side - Content */}
                <div className="flex flex-col justify-between py-4">
                    <AnimatePresence mode="wait">
                        <motion.div
                            key={active}
                            initial={{ opacity: 0, y: 20 }}
                            animate={{ opacity: 1, y: 0 }}
                            exit={{ opacity: 0, y: -20 }}
                            transition={{ duration: 0.2 }}
                        >
                            <h3 className="text-2xl font-bold text-black dark:text-white">
                                {testimonials[active].name}
                            </h3>
                            <p className="text-sm text-gray-500 dark:text-neutral-500">
                                {testimonials[active].designation}
                            </p>
                            <p className="mt-8 text-lg text-gray-500 dark:text-neutral-300">
                                "{testimonials[active].quote}"
                            </p>
                        </motion.div>
                    </AnimatePresence>

                    {/* Navigation buttons */}
                    <div className="flex gap-4 pt-12 md:pt-0">
                        <button
                            onClick={handlePrev}
                            className="flex items-center justify-center bg-gray-100 rounded-full h-7 w-7 dark:bg-neutral-800"
                        >
                            <IconArrowLeft className="w-5 h-5 text-black dark:text-neutral-400" />
                        </button>
                        <button
                            onClick={handleNext}
                            className="flex items-center justify-center bg-gray-100 rounded-full h-7 w-7 dark:bg-neutral-800"
                        >
                            <IconArrowRight className="w-5 h-5 text-black dark:text-neutral-400" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};
