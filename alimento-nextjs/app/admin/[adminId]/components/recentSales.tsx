import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";

interface Listing {
  name: string;
  email: string;
  avatarSrc: string;
  avatarText: string;
  amount: number; // Price for a dish or restaurant
  listingType: string; // Restaurant or Dish type
}

const listingsData: Listing[] = [
  {
    name: "Tandoori Delights",
    email: "tandoori.delights@scruter.com",
    avatarSrc: "/avatars/tandoori.png",
    avatarText: "TD",
    amount: 300.0,
    listingType: "Restaurant - Indian Cuisine",
  },
  {
    name: "Pasta Mania",
    email: "pasta.mania@scruter.com",
    avatarSrc: "/avatars/pasta.png",
    avatarText: "PM",
    amount: 250.0,
    listingType: "Restaurant - Italian Cuisine",
  },
  {
    name: "Sushi World",
    email: "sushi.world@scruter.com",
    avatarSrc: "/avatars/sushi.png",
    avatarText: "SW",
    amount: 450.0,
    listingType: "Restaurant - Japanese Cuisine",
  },
  {
    name: "Burger Shack",
    email: "burger.shack@scruter.com",
    avatarSrc: "/avatars/burger.png",
    avatarText: "BS",
    amount: 120.0,
    listingType: "Restaurant - Fast Food",
  },
  {
    name: "Vegan Bites",
    email: "vegan.bites@scruter.com",
    avatarSrc: "/avatars/vegan.png",
    avatarText: "VB",
    amount: 180.0,
    listingType: "Restaurant - Vegan",
  },
];

export function RecentSales() {
  return (
    <div className="space-y-8 flex items-center justify-center flex-col">
      {listingsData.map((listing, index) => (
        <div className="flex items-center w-full lg:w-3/4 bg-gray-200 dark:bg-gray-700 p-2 rounded-xl" key={index}>
          <Avatar className="h-9 w-9">
            <AvatarImage src={listing.avatarSrc} alt={listing.name} />
            <AvatarFallback>{listing.avatarText}</AvatarFallback>
          </Avatar>
          <div className="grid grid-cols-1 gap-2 lg:grid-cols-2">
            <div className="ml-4 space-y-1 p-2 col-span-1">
              <p className="text-sm font-medium leading-none">{listing.name}</p>
              <p className="text-sm text-muted-foreground">{listing.email}</p>
            </div>
            <div className="ml-4 space-y-1 p-2 col-span-1">
              <div className="ml-auto text-sm font-medium">
                ₹{listing.amount.toLocaleString()}
              </div>
              <p className="ml-auto text-sm text-muted-foreground">
                {listing.listingType}
              </p>
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}
