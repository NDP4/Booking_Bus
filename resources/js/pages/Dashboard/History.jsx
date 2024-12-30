// Use the existing History component code but wrap it in DashboardLayout:

export default function History(props) {
    return (
        <DashboardLayout active="history">
            {/* Your existing History component content */}
        </DashboardLayout>
    );
}
