import { Link, usePage } from "@inertiajs/react";
import { useState } from "react";

export default function DashboardLayout({ children, active = 'profile' }) {
    const { auth } = usePage().props;
    const [isOpen, setIsOpen] = useState(false);

    const navigation = [
        { name: 'Profile', href: '/dashboard/profile', icon: 'UserCircle', current: active === 'profile' },
        { name: 'Riwayat Sewa', href: '/dashboard/history', icon: 'Clock', current: active === 'history' },
    ];

    return (
        <div className="min-h-screen bg-gray-100">
            {/* Navigation */}
            <nav className="bg-white shadow">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex">
                            <div className="flex-shrink-0 flex items-center">
                                <h1 className="text-xl font-bold text-indigo-600">Dashboard</h1>
                            </div>
                        </div>
                        <div className="flex items-center">
                            <span className="text-gray-700">{auth.user.name}</span>
                        </div>
                    </div>
                </div>
            </nav>

            <div className="py-6">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {/* Sidebar */}
                        <div className="col-span-1">
                            <div className="bg-white shadow rounded-lg">
                                <nav className="space-y-1">
                                    {navigation.map((item) => (
                                        <Link
                                            key={item.name}
                                            href={item.href}
                                            className={`${
                                                item.current
                                                    ? 'bg-indigo-50 text-indigo-600'
                                                    : 'text-gray-600 hover:bg-gray-50'
                                            } flex items-center px-4 py-3 text-sm font-medium`}
                                        >
                                            {item.name}
                                        </Link>
                                    ))}
                                </nav>
                            </div>
                        </div>

                        {/* Main Content */}
                        <div className="col-span-1 md:col-span-3">
                            <div className="bg-white shadow rounded-lg">
                                {children}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
