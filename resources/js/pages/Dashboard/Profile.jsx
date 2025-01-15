import { useState } from "react";
import { router } from "@inertiajs/react";
import DashboardLayout from "@/layouts/DashboardLayout";
import { toast, Toaster } from "react-hot-toast";

export default function Profile({ auth }) {
    const [formData, setFormData] = useState({
        name: auth.user.name,
        email: auth.user.email,
        phone: auth.user.phone || "",
        avatar: null,
        current_password: "",
        new_password: "",
        new_password_confirmation: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        router.post("/dashboard/profile", formData, {
            forceFormData: true,
            onSuccess: () => {
                toast.success("Profile updated successfully");
            },
            onError: (errors) => {
                toast.error("Failed to update profile");
            },
        });
    };

    const handleChange = (e) => {
        const { name, value, files } = e.target;
        setFormData((prev) => ({
            ...prev,
            [name]: files ? files[0] : value,
        }));
    };

    return (
        <DashboardLayout active="profile">
            <Toaster position="top-right" />
            <div className="p-8">
                <div className="max-w-3xl mx-auto space-y-8">
                    <div className="pb-6 border-b">
                        <h2 className="text-2xl font-semibold text-gray-900">
                            Edit Profile
                        </h2>
                        <p className="mt-1 text-sm text-gray-500">
                            Update your personal information and account
                            settings
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="space-y-8">
                        {/* Profile Photo */}
                        <div className="flex items-center gap-8">
                            <div className="w-24 h-24 overflow-hidden bg-gray-100 rounded-full shadow ring-4 ring-white">
                                <img
                                    src={
                                        auth.user.avatar_url
                                            ? `/storage/${auth.user.avatar_url}`
                                            : "/default-avatar.png"
                                    }
                                    alt="Profile"
                                    className="object-cover w-full h-full"
                                />
                            </div>
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-700">
                                    Change Photo
                                </label>
                                <input
                                    type="file"
                                    name="avatar"
                                    onChange={handleChange}
                                    className="text-sm transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-indigo-50 file:text-indigo-700 file:font-semibold hover:file:bg-indigo-100"
                                />
                            </div>
                        </div>

                        {/* Form Grid */}
                        <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
                            {/* Name & Email Fields */}
                            <div className="space-y-6">
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-700">
                                        Name
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        value={formData.name}
                                        onChange={handleChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-700">
                                        Email
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        value={formData.email}
                                        onChange={handleChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    />
                                </div>
                            </div>

                            {/* Phone & Password Fields */}
                            <div className="space-y-6">
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-700">
                                        Phone
                                    </label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        value={formData.phone}
                                        onChange={handleChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-700">
                                        New Password
                                    </label>
                                    <input
                                        type="password"
                                        name="new_password"
                                        value={formData.new_password}
                                        onChange={handleChange}
                                        className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    />
                                </div>
                            </div>
                        </div>

                        {/* Submit Button */}
                        <div className="flex justify-end pt-6">
                            <button
                                type="submit"
                                className="px-6 py-3 font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </DashboardLayout>
    );
}
