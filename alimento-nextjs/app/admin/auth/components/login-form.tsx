"use client";

import * as React from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Spinner } from "@/components/ui/spinner";
import { cn } from "@/lib/utils";
import toast, { Toaster } from "react-hot-toast";

interface AdminAuthFormProps extends React.HTMLAttributes<HTMLDivElement> {
  authType: "signup" | "login";
}

export function AdminLoginForm({
  className,
  authType,
  ...props
}: AdminAuthFormProps) {
  const [isLoading, setIsLoading] = React.useState<boolean>(false);
  const [email, setEmail] = React.useState("");

  async function onSubmit(event: React.SyntheticEvent) {
    event.preventDefault();
    setIsLoading(true);

    setIsLoading(false);
  }

  return (
    <div className={cn("grid gap-6", className)} {...props}>
      <Toaster />

      <form onSubmit={onSubmit}>
        <div className="grid gap-2">
          <div className="grid gap-1">
            <Label className="sr-only" htmlFor="email">
              Email
            </Label>
            <Input
              id="email"
              placeholder="name@example.com"
              type="email"
              autoCapitalize="none"
              autoComplete="email"
              autoCorrect="off"
              disabled={isLoading}
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <Button
            type="submit"
            className="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600"
            disabled={isLoading}
          >
            {isLoading ? (
              <Spinner className="mr-2" />
            ) : authType === "signup" ? (
              "Sign Up with Email"
            ) : (
              "Sign In with Email"
            )}
          </Button>
        </div>
      </form>
    </div>
  );
}
