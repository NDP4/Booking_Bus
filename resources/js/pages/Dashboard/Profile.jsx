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
            <div className="p-6">
                <h2 className="mb-6 text-2xl font-bold text-gray-900">
                    Edit Profile
                </h2>

                <form onSubmit={handleSubmit} className="space-y-6">
                    {/* Profile Photo */}
                    <div>
                        <label className="block text-sm font-medium text-gray-700">
                            Profile Photo
                        </label>
                        <div className="flex items-center mt-2 space-x-4">
                            <div className="w-20 h-20 overflow-hidden bg-gray-100 rounded-full">
                                <img
                                    src={
                                        auth.user.avatar_url ||
                                        "/default-avatar.png"
                                    }
                                    alt="Profile"
                                    className="object-cover w-full h-full"
                                />
                            </div>
                            <input
                                type="file"
                                name="avatar"
                                onChange={handleChange}
                                className="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            />
                        </div>
                    </div>

                    {/* Name & Email */}
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Name
                            </label>
                            <input
                                type="text"
                                name="name"
                                value={formData.name}
                                onChange={handleChange}
                                className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            />
                        </div>
                    </div>

                    {/* Phone */}
                    <div>
                        <label className="block text-sm font-medium text-gray-700">
                            Phone
                        </label>
                        <input
                            type="tel"
                            name="phone"
                            value={formData.phone}
                            onChange={handleChange}
                            className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        />
                    </div>

                    {/* Password Change */}
                    <div className="pt-6 space-y-6 border-t">
                        <h3 className="text-lg font-medium text-gray-900">
                            Change Password
                        </h3>

                        <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    Current Password
                                </label>
                                <input
                                    type="password"
                                    name="current_password"
                                    value={formData.current_password}
                                    onChange={handleChange}
                                    className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700">
                                    New Password
                                </label>
                                <input
                                    type="password"
                                    name="new_password"
                                    value={formData.new_password}
                                    onChange={handleChange}
                                    className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                />
                            </div>
                        </div>
                    </div>

                    {/* Submit Button */}
                    <div className="flex justify-end">
                        <button
                            type="submit"
                            className="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </DashboardLayout>
    );
}
