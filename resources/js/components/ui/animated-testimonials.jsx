import React from "react";

export const AnimatedTestimonials = ({ testimonials }) => {
    console.log("AnimatedTestimonials received:", testimonials);

    return (
        <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            {testimonials.map((testimonial, index) => (
                <div
                    key={index}
                    className="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800"
                >
                    <div className="flex items-center mb-4">
                        <img
                            src={testimonial.src}
                            alt={testimonial.name}
                            className="w-12 h-12 rounded-full"
                        />

                        <div className="ml-4">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                {testimonial.name}
                            </h3>
                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                {testimonial.designation}
                            </p>
                        </div>
                    </div>
                    <p className="text-gray-700 dark:text-gray-300">
                        "{testimonial.quote}"
                    </p>
                </div>
            ))}
        </div>
    );
};
